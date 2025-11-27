#!/usr/bin/env python3
"""
Script Python para descargar y organizar el sitio beam.ai/es
Requiere: pip install requests beautifulsoup4 lxml
"""

import os
import requests
from bs4 import BeautifulSoup
from urllib.parse import urljoin, urlparse
import time
from pathlib import Path

class WebsiteDownloader:
    def __init__(self, base_url, output_dir='beam-ai-downloaded'):
        self.base_url = base_url
        self.output_dir = output_dir
        self.visited_urls = set()
        self.session = requests.Session()
        self.session.headers.update({
            'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36'
        })

    def download_file(self, url, local_path):
        """Descarga un archivo y lo guarda localmente"""
        try:
            response = self.session.get(url, timeout=10)
            response.raise_for_status()

            # Crear directorio si no existe
            os.makedirs(os.path.dirname(local_path), exist_ok=True)

            # Guardar archivo
            with open(local_path, 'wb') as f:
                f.write(response.content)
            print(f"✓ Descargado: {url}")
            return True
        except Exception as e:
            print(f"✗ Error descargando {url}: {e}")
            return False

    def get_local_path(self, url):
        """Convierte URL a ruta local"""
        parsed = urlparse(url)
        path = parsed.path.lstrip('/')

        if not path or path.endswith('/'):
            path += 'index.html'

        return os.path.join(self.output_dir, parsed.netloc, path)

    def download_page(self, url):
        """Descarga una página HTML y sus recursos"""
        if url in self.visited_urls:
            return

        self.visited_urls.add(url)
        print(f"\n📄 Procesando: {url}")

        try:
            response = self.session.get(url, timeout=10)
            response.raise_for_status()

            # Guardar HTML
            local_path = self.get_local_path(url)
            os.makedirs(os.path.dirname(local_path), exist_ok=True)

            soup = BeautifulSoup(response.text, 'lxml')

            # Descargar CSS
            for link in soup.find_all('link', rel='stylesheet'):
                if link.get('href'):
                    css_url = urljoin(url, link['href'])
                    css_path = self.get_local_path(css_url)
                    self.download_file(css_url, css_path)

            # Descargar JavaScript
            for script in soup.find_all('script', src=True):
                js_url = urljoin(url, script['src'])
                js_path = self.get_local_path(js_url)
                self.download_file(js_url, js_path)

            # Descargar imágenes
            for img in soup.find_all('img', src=True):
                img_url = urljoin(url, img['src'])
                img_path = self.get_local_path(img_url)
                self.download_file(img_url, img_path)

            # Descargar imágenes de srcset
            for img in soup.find_all('img', srcset=True):
                srcset = img['srcset'].split(',')
                for src in srcset:
                    img_url = urljoin(url, src.strip().split()[0])
                    img_path = self.get_local_path(img_url)
                    self.download_file(img_url, img_path)

            # Guardar HTML
            with open(local_path, 'w', encoding='utf-8') as f:
                f.write(str(soup))

            print(f"✓ Guardado: {local_path}")

            # Pequeña pausa para no sobrecargar el servidor
            time.sleep(1)

        except Exception as e:
            print(f"✗ Error procesando {url}: {e}")

    def run(self):
        """Ejecuta la descarga"""
        print(f"🚀 Iniciando descarga de {self.base_url}")
        print(f"📁 Directorio de salida: {self.output_dir}")
        print("=" * 60)

        self.download_page(self.base_url)

        print("\n" + "=" * 60)
        print(f"✅ Descarga completada!")
        print(f"📊 URLs procesadas: {len(self.visited_urls)}")
        print(f"📁 Archivos en: {os.path.abspath(self.output_dir)}")

if __name__ == '__main__':
    downloader = WebsiteDownloader('https://beam.ai/es/')
    downloader.run()
