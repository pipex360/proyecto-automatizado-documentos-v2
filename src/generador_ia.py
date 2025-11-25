from openai import OpenAI
import os
import re

class GeneradorIA:
    def __init__(self, api_key=None):
        self.api_key = api_key or os.getenv('OPENAI_API_KEY')
        if not self.api_key:
            raise ValueError("Se requiere OPENAI_API_KEY en variables de entorno")
        self.client = OpenAI(api_key=self.api_key)
    
    def limpiar_texto_agresivo(self, texto):
        """Elimina saltos de línea y formato markdown"""
        
        # Remover markdown (negritas, cursivas)
        texto = re.sub(r'\*\*([^*]+)\*\*', r'\1', texto)  # **texto** -> texto
        texto = re.sub(r'\*([^*]+)\*', r'\1', texto)      # *texto* -> texto
        texto = re.sub(r'```.*?```', '', texto, flags=re.DOTALL)
        
        lineas = texto.split('\n')
        resultado = []
        parrafo_actual = []
        
        for linea in lineas:
            stripped = linea.strip()
            
            if not stripped:
                if parrafo_actual:
                    resultado.append(' '.join(parrafo_actual))
                    parrafo_actual = []
                resultado.append('')
                continue
            
            # Detectar separadores
            es_separador = (
                re.match(r'^\d+\.', stripped) or
                re.match(r'^5\.\d+', stripped) or
                stripped.startswith('•') or
                stripped.startswith('-')
            )
            
            if es_separador:
                if parrafo_actual:
                    resultado.append(' '.join(parrafo_actual))
                    parrafo_actual = []
                resultado.append(stripped)
            else:
                parrafo_actual.append(stripped)
        
        if parrafo_actual:
            resultado.append(' '.join(parrafo_actual))
        
        texto_final = '\n'.join(resultado)
        texto_final = re.sub(r' +', ' ', texto_final)
        texto_final = re.sub(r'\n{3,}', '\n\n', texto_final)
        
        return texto_final.strip()
    
    def generar_descripcion_procesos(self, giro_empresa):
        prompt = f"""Genera descripción de procesos para memoria técnica chilena. GIRO: {giro_empresa}

Escribe EXACTAMENTE esto:

2-3 párrafos introductorios largos sobre la actividad

5.1. [Título del proceso]
2 párrafos largos sobre el proceso
La actividad contempla:

1. [Actividad]
• [Detalle]
• [Detalle]

2. [Actividad]
• [Detalle]
• [Detalle]

3. [Actividad]
• [Detalle]
• [Detalle]

4. [Actividad]
• [Detalle]
• [Detalle]

5. [Actividad]
• [Detalle]
• [Detalle]

6. [Actividad]
• [Detalle]
• [Detalle]

NO agregues:
- Título "MEMORIA TÉCNICA"
- Sección "Introducción"  
- Negritas ni cursivas
- Firma ni fecha

Usa lenguaje técnico formal. Genera mínimo 1500 palabras."""

        try:
            response = self.client.chat.completions.create(
                model="gpt-3.5-turbo",
                messages=[
                    {"role": "system", "content": "Generas memorias técnicas chilenas. Texto plano sin formato markdown."},
                    {"role": "user", "content": prompt}
                ],
                temperature=0.7,
                max_tokens=3000
            )
            
            return self.limpiar_texto_agresivo(response.choices[0].message.content)
            
        except Exception as e:
            raise Exception(f"Error: {str(e)}")
