from openai import OpenAI
import os

class GeneradorIA:
    def __init__(self, api_key=None):
        self.api_key = api_key or os.getenv('OPENAI_API_KEY')
        if not self.api_key:
            raise ValueError("Se requiere OPENAI_API_KEY en variables de entorno")
        self.client = OpenAI(api_key=self.api_key)
    
    def generar_descripcion_procesos(self, giro_empresa):
        prompt = f"""Genera una descripción detallada de procesos y actividades para una memoria técnica industrial chilena.

GIRO DE LA EMPRESA: {giro_empresa}

Genera una descripción profesional en español que incluya:
1. Descripción general de los procesos principales
2. Actividades específicas que se realizan
3. Flujo de trabajo típico
4. Aspectos de seguridad relevantes

El texto debe ser formal, técnico y apropiado para una memoria técnica presentada ante autoridades chilenas.
Máximo 2000 palabras."""

        try:
            response = self.client.chat.completions.create(
                model="gpt-3.5-turbo",
                messages=[
                    {"role": "system", "content": "Eres un experto en redacción de memorias técnicas industriales para Chile."},
                    {"role": "user", "content": prompt}
                ],
                temperature=0.7,
                max_tokens=2000
            )
            return response.choices[0].message.content
        except Exception as e:
            raise Exception(f"Error al generar contenido: {str(e)}")
