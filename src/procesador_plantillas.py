from docx import Document
import zipfile
import shutil
import os
import re

class ProcesadorPlantillas:
    def __init__(self, ruta_plantilla):
        self.ruta_plantilla = ruta_plantilla
        self.doc = None
    
    def reemplazar_en_parrafo(self, parrafo, datos):
        """Reemplaza marcadores en un párrafo completo, manejando runs fragmentados"""
        texto_completo = parrafo.text
        
        # Verificar si hay marcadores
        if '{{' not in texto_completo or '}}' not in texto_completo:
            return
        
        # Hacer reemplazos
        texto_nuevo = texto_completo
        for key, value in datos.items():
            marcador = f"{{{{{key}}}}}"
            texto_nuevo = texto_nuevo.replace(marcador, str(value))
        
        # Si cambió algo, reconstruir el párrafo
        if texto_nuevo != texto_completo:
            # Guardar el formato del primer run
            formato_original = None
            if parrafo.runs:
                formato_original = parrafo.runs[0]
            
            # Limpiar todos los runs
            for run in parrafo.runs:
                run.text = ''
            
            # Agregar el texto nuevo en el primer run
            if parrafo.runs:
                parrafo.runs[0].text = texto_nuevo
            else:
                parrafo.add_run(texto_nuevo)
    
    def procesar(self, datos, ruta_salida):
        try:
            # Cargar documento
            self.doc = Document(self.ruta_plantilla)
            
            # Reemplazar en párrafos
            for para in self.doc.paragraphs:
                self.reemplazar_en_parrafo(para, datos)
            
            # Reemplazar en tablas
            for tabla in self.doc.tables:
                for fila in tabla.rows:
                    for celda in fila.cells:
                        for para in celda.paragraphs:
                            self.reemplazar_en_parrafo(para, datos)
            
            # Reemplazar en headers y footers
            for section in self.doc.sections:
                for para in section.header.paragraphs:
                    self.reemplazar_en_parrafo(para, datos)
                for para in section.footer.paragraphs:
                    self.reemplazar_en_parrafo(para, datos)
                
                # Headers y footers también pueden tener tablas
                for tabla in section.header.tables:
                    for fila in tabla.rows:
                        for celda in fila.cells:
                            for para in celda.paragraphs:
                                self.reemplazar_en_parrafo(para, datos)
                
                for tabla in section.footer.tables:
                    for fila in tabla.rows:
                        for celda in fila.cells:
                            for para in celda.paragraphs:
                                self.reemplazar_en_parrafo(para, datos)
            
            # Guardar
            self.doc.save(ruta_salida)
            
            # Segundo paso: reemplazo en XML para elementos que python-docx no alcanza
            temp_salida = ruta_salida + ".temp"
            if self.reemplazar_en_xml(ruta_salida, datos, temp_salida):
                shutil.move(temp_salida, ruta_salida)
            
            return True
        except Exception as e:
            print(f"Error: {e}")
            return False
    
    def reemplazar_en_xml(self, ruta_docx, datos, ruta_salida):
        try:
            temp_dir = 'temp_xml'
            os.makedirs(temp_dir, exist_ok=True)
            
            # Extraer
            with zipfile.ZipFile(ruta_docx, 'r') as zip_ref:
                zip_ref.extractall(temp_dir)
            
            # Procesar todos los XML
            for carpeta, subcarpetas, archivos in os.walk(temp_dir):
                for archivo in archivos:
                    if archivo.endswith('.xml'):
                        ruta = os.path.join(carpeta, archivo)
                        with open(ruta, 'r', encoding='utf-8') as f:
                            contenido = f.read()
                        
                        contenido_nuevo = contenido
                        for key, value in datos.items():
                            marcador = f"{{{{{key}}}}}"
                            contenido_nuevo = contenido_nuevo.replace(marcador, str(value))
                        
                        if contenido_nuevo != contenido:
                            with open(ruta, 'w', encoding='utf-8') as f:
                                f.write(contenido_nuevo)
            
            # Recrear docx
            with zipfile.ZipFile(ruta_salida, 'w', zipfile.ZIP_DEFLATED) as docx:
                for carpeta, subcarpetas, archivos in os.walk(temp_dir):
                    for archivo in archivos:
                        ruta_completa = os.path.join(carpeta, archivo)
                        ruta_en_zip = os.path.relpath(ruta_completa, temp_dir)
                        docx.write(ruta_completa, ruta_en_zip)
            
            # Limpiar
            shutil.rmtree(temp_dir)
            return True
        except Exception as e:
            print(f"Error XML: {e}")
            return False
