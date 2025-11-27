#!/bin/bash

##############################################################################
# Script de instalación automática del tema Beam AI Clone
#
# Uso: ./instalar-tema.sh /ruta/a/wordpress
##############################################################################

set -e  # Salir si hay errores

# Colores para output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Función para imprimir mensajes
print_message() {
    echo -e "${GREEN}✓${NC} $1"
}

print_error() {
    echo -e "${RED}✗${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}⚠${NC} $1"
}

print_info() {
    echo -e "${BLUE}ℹ${NC} $1"
}

# Banner
echo ""
echo "╔════════════════════════════════════════════════════════╗"
echo "║   Instalador de Tema Beam AI Clone para WordPress     ║"
echo "╚════════════════════════════════════════════════════════╝"
echo ""

# Verificar que se proporcionó la ruta de WordPress
if [ -z "$1" ]; then
    print_error "Debes proporcionar la ruta de instalación de WordPress"
    echo ""
    echo "Uso: $0 /ruta/a/wordpress"
    echo ""
    echo "Ejemplos:"
    echo "  $0 /var/www/html"
    echo "  $0 ~/Sites/mi-sitio"
    echo ""
    exit 1
fi

WP_PATH="$1"
THEME_SOURCE="./wordpress-theme/beam-ai-theme"
THEME_DEST="$WP_PATH/wp-content/themes/beam-ai-theme"

# Verificar que existe la ruta de WordPress
if [ ! -d "$WP_PATH" ]; then
    print_error "La ruta $WP_PATH no existe"
    exit 1
fi

# Verificar que es una instalación de WordPress válida
if [ ! -f "$WP_PATH/wp-config.php" ] && [ ! -f "$WP_PATH/wp-config-sample.php" ]; then
    print_error "No se encontró una instalación de WordPress en $WP_PATH"
    exit 1
fi

print_info "WordPress encontrado en: $WP_PATH"

# Verificar que existe el tema fuente
if [ ! -d "$THEME_SOURCE" ]; then
    print_error "No se encontró el tema en $THEME_SOURCE"
    exit 1
fi

print_info "Tema fuente encontrado: $THEME_SOURCE"

# Crear backup si el tema ya existe
if [ -d "$THEME_DEST" ]; then
    print_warning "El tema ya existe. Creando backup..."
    BACKUP_NAME="beam-ai-theme-backup-$(date +%Y%m%d-%H%M%S)"
    mv "$THEME_DEST" "${WP_PATH}/wp-content/themes/${BACKUP_NAME}"
    print_message "Backup creado: $BACKUP_NAME"
fi

# Copiar el tema
print_info "Copiando tema a WordPress..."
cp -r "$THEME_SOURCE" "$THEME_DEST"
print_message "Tema copiado exitosamente"

# Establecer permisos correctos
print_info "Configurando permisos..."
find "$THEME_DEST" -type d -exec chmod 755 {} \;
find "$THEME_DEST" -type f -exec chmod 644 {} \;
print_message "Permisos configurados"

# Verificar si hay archivos descargados para copiar
DOWNLOADED_DIR="./beam-ai-downloaded"

if [ -d "$DOWNLOADED_DIR" ]; then
    print_info "Archivos descargados encontrados. Copiando recursos..."

    # Copiar CSS
    if [ -d "$DOWNLOADED_DIR/beam.ai/es/css" ]; then
        cp -r "$DOWNLOADED_DIR/beam.ai/es/css"/* "$THEME_DEST/assets/css/" 2>/dev/null || true
        print_message "CSS copiados"
    fi

    # Copiar JavaScript
    if [ -d "$DOWNLOADED_DIR/beam.ai/es/js" ]; then
        cp -r "$DOWNLOADED_DIR/beam.ai/es/js"/* "$THEME_DEST/assets/js/" 2>/dev/null || true
        print_message "JavaScript copiados"
    fi

    # Copiar imágenes
    if [ -d "$DOWNLOADED_DIR/beam.ai/es/images" ]; then
        cp -r "$DOWNLOADED_DIR/beam.ai/es/images"/* "$THEME_DEST/assets/images/" 2>/dev/null || true
        print_message "Imágenes copiadas"
    fi

    # Copiar fuentes
    if [ -d "$DOWNLOADED_DIR/beam.ai/es/fonts" ]; then
        cp -r "$DOWNLOADED_DIR/beam.ai/es/fonts"/* "$THEME_DEST/assets/fonts/" 2>/dev/null || true
        print_message "Fuentes copiadas"
    fi
else
    print_warning "No se encontraron archivos descargados en $DOWNLOADED_DIR"
    print_info "Recuerda descargar el sitio original y copiar los recursos manualmente"
fi

# Resumen
echo ""
echo "╔════════════════════════════════════════════════════════╗"
echo "║              ✅ Instalación Completada                 ║"
echo "╚════════════════════════════════════════════════════════╝"
echo ""
print_message "Tema instalado en: $THEME_DEST"
echo ""
print_info "Próximos pasos:"
echo "  1. Ve a tu panel de WordPress"
echo "  2. Navega a Apariencia → Temas"
echo "  3. Activa el tema 'Beam AI Clone'"
echo "  4. Crea una página de inicio y selecciona el template 'Página de Inicio - Beam AI'"
echo "  5. Ve a Ajustes → Lectura y configura la página de inicio"
echo ""

# Mostrar información adicional si no se copiaron recursos
if [ ! -d "$DOWNLOADED_DIR" ]; then
    echo ""
    print_warning "IMPORTANTE: No olvides descargar el sitio original"
    echo ""
    echo "  Ejecuta uno de estos comandos:"
    echo "  - ./download-site.sh"
    echo "  - python3 download-site.py"
    echo ""
    echo "  O descarga manualmente desde el navegador (Ctrl+S en beam.ai/es)"
    echo ""
fi

print_message "¡Instalación completada exitosamente!"
echo ""
