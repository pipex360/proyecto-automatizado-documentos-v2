# 🚀 Proyecto: Clonar Beam.ai/es a WordPress

Este proyecto contiene todo lo necesario para copiar el sitio web **https://beam.ai/es/** y transferirlo a WordPress de forma idéntica.

## 📂 Estructura del Proyecto

```
beam-ai-copy/
├── README.md                    # Este archivo
├── GUIA-COMPLETA.md            # Guía detallada paso a paso
├── download-site.sh            # Script Bash para descargar el sitio
├── download-site.py            # Script Python para descargar el sitio
└── wordpress-theme/
    └── beam-ai-theme/          # Tema de WordPress listo para usar
        ├── style.css           # Hoja de estilos principal del tema
        ├── functions.php       # Funciones del tema
        ├── index.php           # Template principal
        ├── header.php          # Cabecera
        ├── footer.php          # Pie de página
        ├── page.php            # Template de páginas
        ├── templates/          # Templates adicionales
        │   └── page-home.php   # Template para página de inicio
        ├── inc/                # Funciones auxiliares
        │   ├── template-tags.php
        │   └── template-functions.php
        └── assets/             # Recursos (CSS, JS, imágenes)
            ├── css/
            │   └── custom.css  # Estilos personalizados
            ├── js/
            │   └── custom.js   # JavaScript personalizado
            ├── images/         # Carpeta para imágenes del sitio original
            └── fonts/          # Carpeta para fuentes del sitio original
```

## 🎯 Proceso Rápido (3 Pasos)

### Paso 1: Descargar el sitio original

Elige uno de estos métodos:

#### Opción A: Script Bash (Linux/Mac)
```bash
chmod +x download-site.sh
./download-site.sh
```

#### Opción B: Script Python (Cualquier sistema)
```bash
pip install requests beautifulsoup4 lxml
python3 download-site.py
```

#### Opción C: Manual con navegador
1. Abre https://beam.ai/es/ en tu navegador
2. Click derecho → "Guardar como" → "Página web, completa"

### Paso 2: Copiar archivos al tema de WordPress

Después de descargar el sitio, copia los recursos al tema:

```bash
# Navega a la carpeta descargada
cd beam-ai-downloaded/beam.ai/es/

# Copia CSS
cp -r css/* /ruta/a/wordpress/wp-content/themes/beam-ai-theme/assets/css/

# Copia JavaScript
cp -r js/* /ruta/a/wordpress/wp-content/themes/beam-ai-theme/assets/js/

# Copia imágenes
cp -r images/* /ruta/a/wordpress/wp-content/themes/beam-ai-theme/assets/images/

# Copia fuentes (si existen)
cp -r fonts/* /ruta/a/wordpress/wp-content/themes/beam-ai-theme/assets/fonts/
```

### Paso 3: Instalar y activar el tema en WordPress

1. Copia la carpeta `wordpress-theme/beam-ai-theme/` a `wp-content/themes/`
2. Ve a **Apariencia → Temas** en WordPress
3. Activa el tema "Beam AI Clone"
4. Ve a **Páginas → Añadir nueva** y crea tu página de inicio
5. Selecciona el template "Página de Inicio - Beam AI"

## 📚 Guías Detalladas

### Para instrucciones completas paso a paso:
👉 **Lee el archivo [GUIA-COMPLETA.md](GUIA-COMPLETA.md)**

Incluye:
- Análisis de la estructura del sitio
- Preparación de WordPress
- Creación del tema personalizado
- Transferencia de contenido
- Optimización final
- Solución de problemas

## 🛠️ Requisitos

### Para descargar el sitio:
- **Opción Bash**: Linux, macOS, o WSL en Windows
  - `wget` instalado
- **Opción Python**: Python 3.6+
  - `pip install requests beautifulsoup4 lxml`

### Para WordPress:
- WordPress 6.0 o superior
- PHP 7.4 o superior
- Servidor web (Apache/Nginx)
- MySQL 5.7+ o MariaDB 10.3+

### Plugins recomendados:
- **Elementor** o **WPBakery** - Constructor de páginas visual
- **Advanced Custom Fields** - Campos personalizados
- **Yoast SEO** - Optimización SEO
- **Autoptimize** - Optimización de rendimiento

## ✨ Características del Tema

### ✅ Funcionalidades incluidas:

- 📱 **Responsive Design** - Compatible con todos los dispositivos
- ⚡ **Optimizado para rendimiento**
- 🎨 **Estilos personalizables** desde el Customizer de WordPress
- 🔍 **SEO-friendly** - Código limpio y semántico
- ♿ **Accesible** - Cumple estándares WCAG
- 🔧 **Custom Post Types** - Para testimonios y características
- 📋 **Templates personalizados** - Página de inicio especial
- 🎯 **Menús de navegación** - Header y footer
- 🖼️ **Soporte para imágenes destacadas**
- 📝 **Widgets** - Áreas de widgets en sidebar y footer
- 🚀 **Lazy loading** de imágenes
- 🎬 **Animaciones suaves** al scroll
- 🔒 **Seguro** - Código limpio sin vulnerabilidades

### 🎨 Personalización disponible:

Desde **Apariencia → Personalizar**:
- Logo del sitio
- Texto y URL del botón CTA
- Colores (puedes extender en `style.css`)
- Menús de navegación

## 📋 Checklist de Instalación

- [ ] ✅ Descargar el sitio beam.ai/es
- [ ] ✅ Copiar recursos (CSS, JS, imágenes) al tema
- [ ] ✅ Instalar WordPress
- [ ] ✅ Subir el tema a `wp-content/themes/`
- [ ] ✅ Activar el tema
- [ ] ✅ Configurar menús de navegación
- [ ] ✅ Crear páginas necesarias
- [ ] ✅ Seleccionar template "Página de Inicio - Beam AI"
- [ ] ✅ Copiar contenido del HTML original
- [ ] ✅ Ajustar rutas de imágenes si es necesario
- [ ] ✅ Probar en diferentes dispositivos
- [ ] ✅ Optimizar imágenes
- [ ] ✅ Configurar SEO
- [ ] ✅ Realizar pruebas finales

## 🔧 Solución Rápida de Problemas

### Los estilos no se cargan
```php
// Verifica que el archivo existe en:
// wp-content/themes/beam-ai-theme/assets/css/main.css
```

### Las imágenes no se muestran
```php
// En los templates, usa:
<?php echo get_template_directory_uri(); ?>/assets/images/nombre-imagen.jpg
```

### El menú no aparece
1. Ve a **Apariencia → Menús**
2. Crea un nuevo menú
3. Asígnalo a la ubicación "Menú Principal"

## 🎓 Próximos Pasos

1. **Descarga el sitio** usando uno de los scripts proporcionados
2. **Lee la [GUIA-COMPLETA.md](GUIA-COMPLETA.md)** para instrucciones detalladas
3. **Instala el tema** en tu WordPress
4. **Copia el contenido** del sitio original
5. **Personaliza** según tus necesidades

## 📞 ¿Necesitas Ayuda?

Si encuentras algún problema:

1. Revisa la [GUIA-COMPLETA.md](GUIA-COMPLETA.md) en la sección "Solución de Problemas"
2. Verifica que todos los archivos están en sus ubicaciones correctas
3. Revisa los permisos de archivos (755 para carpetas, 644 para archivos)
4. Verifica la consola del navegador (F12) para errores

## 📄 Licencia

Este tema es código abierto. El contenido visual y diseño pertenecen a beam.ai.

---

**Creado para facilitar la transferencia de beam.ai/es a WordPress**

¡Éxito con tu proyecto! 🎉
