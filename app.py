from flask import Flask, render_template, request, send_file, jsonify
import os
import sys
from datetime import datetime

# Agregar src al path
sys.path.insert(0, os.path.dirname(os.path.abspath(__file__)))

from src.procesador_plantillas import ProcesadorPlantillas
from src.generador_ia import GeneradorIA

app = Flask(__name__, template_folder='web_templates')
app.config['TEMPLATES_FOLDER'] = 'templates'
app.config['OUTPUT_FOLDER'] = 'outputs'

# Crear carpetas si no existen
os.makedirs(app.config['OUTPUT_FOLDER'], exist_ok=True)

@app.route('/')
def index():
    return render_template('simple.html')

@app.route('/generar', methods=['POST'])
def generar():
    try:
        datos = request.json
        
        # Validar campos requeridos
        campos_requeridos = ['EMPRESA', 'RUT', 'GIRO', 'DIRECCION',
                           'NUMERO_TRABAJADORES', 'SUPERFICIE_CONSTRUIDA',
                           'SUPERFICIE_TERRENO', 'NUMERO_EXTINTORES',
                           'DESCRIPCION_PROCESOS']
        
        for campo in campos_requeridos:
            if campo not in datos or not datos[campo]:
                return jsonify({'error': f'Campo {campo} es requerido'}), 400
        
        # Procesar plantilla
        plantilla = os.path.join(app.config['TEMPLATES_FOLDER'], 'Plantilla_Final.docx')
        
        if not os.path.exists(plantilla):
            return jsonify({'error': 'Plantilla no encontrada'}), 500
        
        # Generar nombre de archivo de salida
        timestamp = datetime.now().strftime('%Y%m%d_%H%M%S')
        nombre_empresa = datos['EMPRESA'].replace(' ', '_')[:30]
        archivo_salida = os.path.join(
            app.config['OUTPUT_FOLDER'],
            f'Memoria_{nombre_empresa}_{timestamp}.docx'
        )
        
        # Procesar
        procesador = ProcesadorPlantillas(plantilla)
        if procesador.procesar(datos, archivo_salida):
            return send_file(
                archivo_salida,
                as_attachment=True,
                download_name=f'Memoria_{nombre_empresa}.docx'
            )
        else:
            return jsonify({'error': 'Error al procesar el documento'}), 500
            
    except Exception as e:
        return jsonify({'error': str(e)}), 500

@app.route('/generar-ia', methods=['POST'])
def generar_ia():
    try:
        datos = request.json
        giro = datos.get('giro', '')
        
        if not giro:
            return jsonify({'error': 'Se requiere el giro de la empresa'}), 400
        
        generador = GeneradorIA()
        descripcion = generador.generar_descripcion_procesos(giro)
        
        return jsonify({'descripcion': descripcion})
    except Exception as e:
        return jsonify({'error': str(e)}), 500

if __name__ == '__main__':
    print("\n" + "="*60)
    print("    AUTOMATIZADOR DE DOCUMENTOS WORD")
    print("="*60)
    print("\nServidor iniciado en: http://localhost:8080")
    print("Presiona Ctrl+C para detener\n")
    print("="*60 + "\n")
    
    app.run(host='0.0.0.0', port=8080, debug=True)
