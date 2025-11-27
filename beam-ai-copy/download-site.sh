#!/bin/bash
# Script para descargar el sitio web beam.ai/es completo

echo "Descargando sitio web beam.ai/es..."

# Crear directorio de descarga
mkdir -p beam-ai-downloaded
cd beam-ai-downloaded

# Descargar el sitio completo con wget
wget --mirror \
     --convert-links \
     --adjust-extension \
     --page-requisites \
     --no-parent \
     --no-clobber \
     --user-agent="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36" \
     --wait=1 \
     --random-wait \
     --execute robots=off \
     --reject-regex="(.*\.(pdf|zip|tar|gz|rar|exe|dmg))$" \
     https://beam.ai/es/

echo "Descarga completada en: $(pwd)"
echo ""
echo "Archivos descargados:"
find beam.ai -type f | head -20
echo ""
echo "Total de archivos: $(find beam.ai -type f | wc -l)"
