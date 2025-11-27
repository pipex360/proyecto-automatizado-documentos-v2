#!/usr/bin/env python3
"""
Script para analizar y descargar beam.ai/es con todos sus recursos
Este script es más completo y maneja mejor los recursos dinámicos
"""

import os
import re
import json
import requests
from bs4 import BeautifulSoup
from urllib.parse import urljoin, urlparse
import time
from pathlib import Path

class BeamAIDownloader:
    def __init__(self, url='https://beam.ai/es/', output_dir='beam-ai-complete'):
        self.url = url
        self.output_dir = output_dir
        self.session = requests.Session()
        self.session.headers.update({
            'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
            'Accept': 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
            'Accept-Language': 'es-ES,es;q=0.9,en;q=0.8',
        })
        self.downloaded = set()

    def create_directory_structure(self):
        """Crea la estructura de directorios necesaria"""
        dirs = ['css', 'js', 'images', 'fonts', 'videos']
        for d in dirs:
            Path(os.path.join(self.output_dir, d)).mkdir(parents=True, exist_ok=True)

    def download_file(self, url, local_path):
        """Descarga un archivo"""
        if url in self.downloaded:
            return True

        try:
            print(f"  📥 Descargando: {url}")
            response = self.session.get(url, timeout=15, stream=True)
            response.raise_for_status()

            os.makedirs(os.path.dirname(local_path), exist_ok=True)

            with open(local_path, 'wb') as f:
                for chunk in response.iter_content(chunk_size=8192):
                    if chunk:
                        f.write(chunk)

            self.downloaded.add(url)
            print(f"  ✓ Guardado: {local_path}")
            return True

        except Exception as e:
            print(f"  ✗ Error: {e}")
            return False

    def analyze_page(self):
        """Analiza la página y extrae información sobre los recursos"""
        print("🔍 Analizando estructura de beam.ai/es...\n")

        try:
            response = self.session.get(self.url, timeout=15)
            response.raise_for_status()
            soup = BeautifulSoup(response.text, 'html.parser')

            analysis = {
                'css_files': [],
                'js_files': [],
                'images': [],
                'fonts': [],
                'inline_styles': [],
                'inline_scripts': [],
                'external_libraries': [],
                'sections': [],
                'animations': [],
                'effects': []
            }

            # Analizar CSS
            print("📄 CSS encontrados:")
            for link in soup.find_all('link', rel='stylesheet'):
                href = link.get('href')
                if href:
                    full_url = urljoin(self.url, href)
                    analysis['css_files'].append(full_url)
                    print(f"  - {full_url}")

            # Analizar JavaScript
            print("\n📜 JavaScript encontrados:")
            for script in soup.find_all('script', src=True):
                src = script.get('src')
                if src:
                    full_url = urljoin(self.url, src)
                    analysis['js_files'].append(full_url)
                    print(f"  - {full_url}")

            # Analizar imágenes
            print("\n🖼️  Imágenes encontradas:")
            for img in soup.find_all('img'):
                src = img.get('src') or img.get('data-src')
                if src:
                    full_url = urljoin(self.url, src)
                    analysis['images'].append(full_url)
                    print(f"  - {full_url}")

            # Buscar efectos y animaciones en el HTML
            print("\n✨ Buscando efectos y animaciones:")

            # Buscar clases relacionadas con animaciones
            animation_keywords = ['animate', 'fade', 'slide', 'zoom', 'parallax', 'scroll', 'aos', 'gsap']
            all_classes = set()

            for element in soup.find_all(class_=True):
                classes = element.get('class', [])
                for cls in classes:
                    if any(keyword in cls.lower() for keyword in animation_keywords):
                        all_classes.add(cls)

            if all_classes:
                print("  Clases de animación encontradas:")
                for cls in sorted(all_classes):
                    print(f"    - {cls}")
                analysis['animations'] = list(all_classes)

            # Analizar estructura de secciones
            print("\n📐 Estructura de secciones:")
            sections = soup.find_all(['section', 'div'], class_=lambda x: x and ('section' in str(x).lower() or 'container' in str(x).lower()))
            for i, section in enumerate(sections[:10], 1):  # Primeras 10 secciones
                section_class = ' '.join(section.get('class', []))
                section_id = section.get('id', 'sin-id')
                print(f"  {i}. <{section.name}> id='{section_id}' class='{section_class}'")
                analysis['sections'].append({
                    'tag': section.name,
                    'id': section_id,
                    'classes': section_class
                })

            # Guardar análisis
            analysis_file = os.path.join(self.output_dir, 'analysis.json')
            with open(analysis_file, 'w', encoding='utf-8') as f:
                json.dump(analysis, f, indent=2, ensure_ascii=False)
            print(f"\n💾 Análisis guardado en: {analysis_file}")

            # Guardar HTML completo
            html_file = os.path.join(self.output_dir, 'index.html')
            with open(html_file, 'w', encoding='utf-8') as f:
                f.write(response.text)
            print(f"💾 HTML guardado en: {html_file}")

            return analysis

        except Exception as e:
            print(f"❌ Error al analizar: {e}")
            return None

    def download_all_resources(self, analysis):
        """Descarga todos los recursos analizados"""
        if not analysis:
            return

        print("\n" + "="*60)
        print("📦 Descargando todos los recursos...")
        print("="*60 + "\n")

        # Descargar CSS
        if analysis['css_files']:
            print("📄 Descargando CSS...")
            for css_url in analysis['css_files']:
                filename = os.path.basename(urlparse(css_url).path) or 'style.css'
                local_path = os.path.join(self.output_dir, 'css', filename)
                self.download_file(css_url, local_path)
                time.sleep(0.5)

        # Descargar JavaScript
        if analysis['js_files']:
            print("\n📜 Descargando JavaScript...")
            for js_url in analysis['js_files']:
                filename = os.path.basename(urlparse(js_url).path) or 'script.js'
                local_path = os.path.join(self.output_dir, 'js', filename)
                self.download_file(js_url, local_path)
                time.sleep(0.5)

        # Descargar imágenes
        if analysis['images']:
            print("\n🖼️  Descargando imágenes...")
            for i, img_url in enumerate(analysis['images'][:20], 1):  # Primeras 20 imágenes
                filename = os.path.basename(urlparse(img_url).path) or f'image_{i}.jpg'
                local_path = os.path.join(self.output_dir, 'images', filename)
                self.download_file(img_url, local_path)
                time.sleep(0.3)

    def run(self):
        """Ejecuta el proceso completo"""
        print("="*60)
        print("🚀 BEAM.AI/ES - Descargador Completo")
        print("="*60 + "\n")

        self.create_directory_structure()
        analysis = self.analyze_page()

        if analysis:
            print("\n" + "="*60)
            print("📊 RESUMEN DEL ANÁLISIS")
            print("="*60)
            print(f"✓ CSS encontrados: {len(analysis['css_files'])}")
            print(f"✓ JavaScript encontrados: {len(analysis['js_files'])}")
            print(f"✓ Imágenes encontradas: {len(analysis['images'])}")
            print(f"✓ Secciones analizadas: {len(analysis['sections'])}")
            print(f"✓ Animaciones detectadas: {len(analysis['animations'])}")

            # Preguntar si descargar recursos
            print("\n¿Descargar todos los recursos? (s/n): ", end='')
            # En modo automático, descargamos
            self.download_all_resources(analysis)

        print("\n" + "="*60)
        print("✅ PROCESO COMPLETADO")
        print("="*60)
        print(f"\n📁 Archivos en: {os.path.abspath(self.output_dir)}")
        print("\n📋 Próximos pasos:")
        print("  1. Revisa el archivo 'analysis.json' para ver todos los recursos")
        print("  2. Revisa 'index.html' para ver la estructura completa")
        print("  3. Copia los archivos CSS, JS e imágenes al tema de WordPress")

if __name__ == '__main__':
    downloader = BeamAIDownloader()
    downloader.run()
