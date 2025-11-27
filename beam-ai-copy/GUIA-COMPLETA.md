# Guía Completa: Copiar beam.ai/es a WordPress

## 📋 Tabla de Contenidos
1. [Descarga del Sitio Original](#1-descarga-del-sitio-original)
2. [Análisis de la Estructura](#2-análisis-de-la-estructura)
3. [Preparación de WordPress](#3-preparación-de-wordpress)
4. [Creación del Tema Personalizado](#4-creación-del-tema-personalizado)
5. [Transferencia de Contenido](#5-transferencia-de-contenido)
6. [Optimización Final](#6-optimización-final)

---

## 1. Descarga del Sitio Original

### Opción A: Usando el script Bash (Linux/Mac)

```bash
# Dar permisos de ejecución
chmod +x download-site.sh

# Ejecutar el script
./download-site.sh
```

### Opción B: Usando el script Python (Cualquier SO)

```bash
# Instalar dependencias
pip install requests beautifulsoup4 lxml

# Ejecutar el script
python3 download-site.py
```

### Opción C: Manualmente con navegador

1. Abre https://beam.ai/es/ en Chrome/Firefox
2. Click derecho → "Guardar como" → "Página web, completa"
3. Esto descargará el HTML y una carpeta con recursos

---

## 2. Análisis de la Estructura

Después de descargar, revisa la estructura del sitio:

```bash
cd beam-ai-downloaded/beam.ai/es
ls -la
```

### Elementos típicos a buscar:

- **HTML principal**: `index.html`
- **CSS**: Carpeta `css/` o archivos `.css`
- **JavaScript**: Carpeta `js/` o archivos `.js`
- **Imágenes**: Carpeta `images/`, `img/`, o `assets/`
- **Fuentes**: Carpeta `fonts/` o enlaces a Google Fonts

### Estructura esperada del sitio Beam.ai:

```
beam.ai/es/
├── index.html           # Página principal
├── css/
│   ├── main.css        # Estilos principales
│   └── responsive.css  # Estilos responsive
├── js/
│   ├── main.js         # JavaScript principal
│   └── vendors/        # Librerías de terceros
├── images/
│   ├── logo.svg
│   ├── hero/
│   └── icons/
└── fonts/
    └── custom-fonts/
```

---

## 3. Preparación de WordPress

### 3.1 Instalación de WordPress

Si aún no tienes WordPress:

```bash
# Descarga WordPress
wget https://wordpress.org/latest.tar.gz
tar -xzf latest.tar.gz

# O usa un instalador local como Local by Flywheel, XAMPP, o MAMP
```

### 3.2 Plugins Recomendados

Instala estos plugins para facilitar la transferencia:

1. **Advanced Custom Fields (ACF)** - Para campos personalizados
2. **Elementor o WPBakery** - Constructor de páginas
3. **Custom Post Type UI** - Para tipos de contenido personalizados
4. **All-in-One WP Migration** - Para importar/exportar
5. **Better Search Replace** - Para reemplazar URLs

---

## 4. Creación del Tema Personalizado

### 4.1 Estructura del Tema

Usa la estructura del tema que se crea en `wordpress-theme/`:

```
beam-ai-theme/
├── style.css           # Estilos y metadatos del tema
├── functions.php       # Funciones del tema
├── index.php          # Template principal
├── header.php         # Cabecera
├── footer.php         # Pie de página
├── page.php           # Template de páginas
├── single.php         # Template de posts
├── assets/
│   ├── css/          # CSS del sitio original
│   ├── js/           # JavaScript del sitio original
│   ├── images/       # Imágenes del sitio original
│   └── fonts/        # Fuentes del sitio original
└── templates/
    └── page-home.php  # Template de página de inicio
```

### 4.2 Instalación del Tema

1. Copia la carpeta `beam-ai-theme/` a `wp-content/themes/`
2. Copia los archivos descargados a `beam-ai-theme/assets/`:
   ```bash
   cp -r beam-ai-downloaded/beam.ai/es/css/* wp-content/themes/beam-ai-theme/assets/css/
   cp -r beam-ai-downloaded/beam.ai/es/js/* wp-content/themes/beam-ai-theme/assets/js/
   cp -r beam-ai-downloaded/beam.ai/es/images/* wp-content/themes/beam-ai-theme/assets/images/
   ```
3. Activa el tema desde: **Apariencia → Temas**

---

## 5. Transferencia de Contenido

### 5.1 Analizar el HTML Original

Abre el `index.html` descargado y identifica las secciones:

```html
<!-- Ejemplo de estructura típica -->
<header>
  <nav>...</nav>
</header>

<main>
  <section class="hero">...</section>
  <section class="features">...</section>
  <section class="pricing">...</section>
  <section class="testimonials">...</section>
  <section class="cta">...</section>
</main>

<footer>...</footer>
```

### 5.2 Crear Páginas en WordPress

1. Ve a **Páginas → Añadir nueva**
2. Crea una página para cada sección principal
3. Usa Elementor o el editor de bloques de Gutenberg

### 5.3 Copiar Contenido

#### Método 1: Constructor de Páginas (Elementor)

1. Instala Elementor
2. Copia el HTML de cada sección
3. Pégalo en widgets HTML de Elementor
4. Ajusta estilos visualmente

#### Método 2: Shortcodes Personalizados

Crea shortcodes en `functions.php`:

```php
// Ejemplo de shortcode para sección hero
function beam_hero_section() {
    ob_start();
    ?>
    <section class="hero">
        <!-- Pega aquí el HTML original de la sección hero -->
    </section>
    <?php
    return ob_get_clean();
}
add_shortcode('beam_hero', 'beam_hero_section');
```

Úsalo en páginas: `[beam_hero]`

### 5.4 Ajustar Rutas de Recursos

Busca y reemplaza rutas en el HTML:

```
De:  /css/main.css
A:   <?php echo get_template_directory_uri(); ?>/assets/css/main.css

De:  /images/logo.png
A:   <?php echo get_template_directory_uri(); ?>/assets/images/logo.png
```

---

## 6. Optimización Final

### 6.1 Optimización de Imágenes

```bash
# Instalar herramienta de optimización
sudo apt-get install optipng jpegoptim

# Optimizar PNG
find wp-content/themes/beam-ai-theme/assets/images -name "*.png" -exec optipng {} \;

# Optimizar JPEG
find wp-content/themes/beam-ai-theme/assets/images -name "*.jpg" -exec jpegoptim --max=85 {} \;
```

### 6.2 Minificar CSS y JavaScript

Usa plugins como:
- **Autoptimize** - Minifica CSS, JS y HTML
- **WP Rocket** - Caché y optimización completa

### 6.3 Configuración de SEO

1. Instala **Yoast SEO** o **Rank Math**
2. Configura títulos y meta descripciones
3. Crea un sitemap XML
4. Optimiza URLs amigables

### 6.4 Responsive y Compatibilidad

1. Prueba en diferentes dispositivos
2. Usa las DevTools del navegador
3. Ajusta CSS con media queries si es necesario

### 6.5 Verificación Final

- [ ] Todas las páginas se muestran correctamente
- [ ] Imágenes cargan sin errores 404
- [ ] CSS y JavaScript funcionan
- [ ] Navegación funciona
- [ ] Formularios funcionan (si los hay)
- [ ] Compatible con móviles
- [ ] Velocidad de carga aceptable
- [ ] SEO básico configurado

---

## 🔧 Solución de Problemas Comunes

### CSS no se carga

**Problema**: Los estilos no se aplican
**Solución**:
```php
// En functions.php, verifica:
function beam_enqueue_styles() {
    wp_enqueue_style('main-style', get_template_directory_uri() . '/assets/css/main.css');
}
add_action('wp_enqueue_scripts', 'beam_enqueue_styles');
```

### Imágenes rotas

**Problema**: Imágenes no se muestran
**Solución**:
1. Verifica que las imágenes estén en `/assets/images/`
2. Revisa permisos de archivos: `chmod 755 images/`
3. Usa rutas absolutas con `get_template_directory_uri()`

### JavaScript no funciona

**Problema**: Interactividad no funciona
**Solución**:
```php
// En functions.php
function beam_enqueue_scripts() {
    wp_enqueue_script('main-js', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'beam_enqueue_scripts');
```

### Conflictos con jQuery

**Problema**: Scripts que usan $ no funcionan
**Solución**:
```javascript
// En tus archivos JS, usa:
jQuery(document).ready(function($) {
    // Tu código aquí
});
```

---

## 📞 Próximos Pasos

1. **Ejecuta uno de los scripts de descarga**
2. **Sube los archivos aquí** para que los organice en el tema de WordPress
3. **Configura tu WordPress** local o en servidor
4. **Instala el tema** que voy a crear
5. **Ajusta el contenido** según necesites

¿Tienes WordPress ya instalado? ¿Prefieres que cree el tema completo ahora o esperas a tener los archivos descargados?
