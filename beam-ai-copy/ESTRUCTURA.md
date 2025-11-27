# 📁 Estructura Detallada del Proyecto

## Vista General del Proyecto

```
beam-ai-copy/
│
├── 📄 README.md                        # Documentación principal
├── 📄 GUIA-COMPLETA.md                 # Guía paso a paso detallada
├── 📄 INSTRUCCIONES-RAPIDAS.md         # Guía rápida en 5 minutos
├── 📄 ESTRUCTURA.md                    # Este archivo
│
├── 🔧 download-site.sh                 # Script Bash para descargar sitio
├── 🐍 download-site.py                 # Script Python para descargar sitio
├── ⚙️  instalar-tema.sh                 # Script de instalación automática
│
└── 📂 wordpress-theme/
    └── 📂 beam-ai-theme/               # ⭐ TEMA PRINCIPAL DE WORDPRESS
        │
        ├── 📄 style.css                # Hoja de estilos y metadatos del tema
        ├── 📄 functions.php            # Funciones principales del tema
        ├── 📄 index.php                # Template principal (fallback)
        ├── 📄 header.php               # Cabecera del sitio
        ├── 📄 footer.php               # Pie de página del sitio
        ├── 📄 page.php                 # Template de páginas estándar
        ├── 📄 single.php               # Template de posts individuales
        ├── 📄 sidebar.php              # Sidebar/barra lateral
        ├── 📄 screenshot.png           # Screenshot del tema (placeholder)
        │
        ├── 📂 templates/               # Templates personalizados
        │   ├── 📄 page-home.php        # Template para página de inicio
        │   └── 📂 sections/            # Secciones reutilizables
        │       └── (agregar secciones aquí)
        │
        ├── 📂 inc/                     # Funciones auxiliares
        │   ├── 📄 template-tags.php    # Tags/helpers para templates
        │   └── 📄 template-functions.php # Funciones adicionales
        │
        └── 📂 assets/                  # Recursos del sitio
            │
            ├── 📂 css/                 # Hojas de estilo
            │   └── 📄 custom.css       # Estilos personalizados de WordPress
            │   └── (copiar aquí CSS del sitio original)
            │
            ├── 📂 js/                  # JavaScript
            │   └── 📄 custom.js        # JavaScript personalizado de WordPress
            │   └── (copiar aquí JS del sitio original)
            │
            ├── 📂 images/              # Imágenes
            │   ├── 📂 icons/           # Iconos SVG
            │   └── (copiar aquí imágenes del sitio original)
            │
            └── 📂 fonts/               # Tipografías
                └── (copiar aquí fuentes del sitio original)
```

## 📄 Descripción de Archivos Principales

### Documentación

| Archivo | Descripción | Cuándo usar |
|---------|-------------|-------------|
| `README.md` | Documentación completa del proyecto | Para entender el proyecto completo |
| `GUIA-COMPLETA.md` | Guía detallada paso a paso | Para proceso completo y detallado |
| `INSTRUCCIONES-RAPIDAS.md` | Guía rápida en 5 minutos | Para instalación rápida |
| `ESTRUCTURA.md` | Este archivo - estructura del proyecto | Para entender organización |

### Scripts de Utilidad

| Script | Lenguaje | Función | Requisitos |
|--------|----------|---------|------------|
| `download-site.sh` | Bash | Descarga sitio con wget | Linux/Mac, wget instalado |
| `download-site.py` | Python | Descarga sitio con Python | Python 3.6+, requests, bs4 |
| `instalar-tema.sh` | Bash | Instalación automática del tema | Linux/Mac |

### Archivos del Tema WordPress

#### Archivos Core (Requeridos)

| Archivo | Descripción | Requerido |
|---------|-------------|-----------|
| `style.css` | Metadatos del tema y estilos base | ✅ Sí |
| `functions.php` | Configuración y funcionalidades | ✅ Sí |
| `index.php` | Template fallback principal | ✅ Sí |

#### Templates HTML

| Archivo | Descripción | Uso |
|---------|-------------|-----|
| `header.php` | Cabecera común (logo, nav) | Todas las páginas |
| `footer.php` | Pie de página común | Todas las páginas |
| `page.php` | Páginas estándar | Páginas de WordPress |
| `single.php` | Posts individuales | Posts de blog |
| `sidebar.php` | Barra lateral | Páginas con sidebar |

#### Templates Personalizados

| Archivo | Descripción | Selección |
|---------|-------------|-----------|
| `templates/page-home.php` | Página de inicio especial | Desde "Atributos de página" |

#### Funciones Auxiliares

| Archivo | Contiene | Propósito |
|---------|----------|-----------|
| `inc/template-tags.php` | Helpers para templates | Funciones reutilizables |
| `inc/template-functions.php` | Funcionalidades extra | Optimizaciones y mejoras |

## 📂 Carpeta Assets - Detalle

### CSS
```
assets/css/
├── custom.css          # Estilos propios de WordPress (ya creado)
└── main.css           # CSS del sitio original (copiar aquí)
```

### JavaScript
```
assets/js/
├── custom.js          # JS propio de WordPress (ya creado)
└── main.js            # JS del sitio original (copiar aquí)
```

### Imágenes
```
assets/images/
├── icons/             # Iconos SVG
├── logo.svg           # Logo del sitio
└── ...                # Imágenes del sitio original (copiar aquí)
```

### Fuentes
```
assets/fonts/
└── ...                # Fuentes del sitio original (copiar aquí)
```

## 🔄 Flujo de Trabajo

### 1. Descarga del Sitio Original
```
beam.ai/es → download-site.sh/py → beam-ai-downloaded/
```

### 2. Organización de Recursos
```
beam-ai-downloaded/
└── beam.ai/es/
    ├── css/      → copiar a → assets/css/
    ├── js/       → copiar a → assets/js/
    ├── images/   → copiar a → assets/images/
    └── fonts/    → copiar a → assets/fonts/
```

### 3. Instalación en WordPress
```
wordpress-theme/beam-ai-theme/ → copiar a → wp-content/themes/beam-ai-theme/
```

### 4. Activación
```
Panel WordPress → Apariencia → Temas → Activar "Beam AI Clone"
```

## 📋 Checklist de Archivos

### Archivos que YA están creados ✅

- [x] style.css
- [x] functions.php
- [x] index.php
- [x] header.php
- [x] footer.php
- [x] page.php
- [x] single.php
- [x] sidebar.php
- [x] templates/page-home.php
- [x] inc/template-tags.php
- [x] inc/template-functions.php
- [x] assets/css/custom.css
- [x] assets/js/custom.js

### Archivos/Carpetas que DEBES copiar del sitio original 📥

- [ ] assets/css/main.css (del sitio original)
- [ ] assets/css/*.css (otros CSS del sitio original)
- [ ] assets/js/main.js (del sitio original)
- [ ] assets/js/*.js (otros JS del sitio original)
- [ ] assets/images/* (todas las imágenes)
- [ ] assets/fonts/* (todas las fuentes)

## 🎯 Estructura Recomendada de Contenido en WordPress

Después de instalar el tema, crea este contenido:

```
WordPress Admin
│
├── 📄 Páginas
│   ├── Inicio (Template: Página de Inicio - Beam AI)
│   ├── Acerca de
│   ├── Servicios
│   └── Contacto
│
├── 📝 Menús
│   ├── Menú Principal (Header)
│   └── Menú Footer
│
├── 🎨 Personalizar
│   ├── Identidad del sitio (Logo)
│   ├── Configuración Beam AI (CTA)
│   └── Widgets
│
└── ⚙️ Ajustes
    └── Lectura → Página de inicio: "Inicio"
```

## 💡 Notas Importantes

1. **No modifiques** los archivos core del tema directamente. Usa un tema hijo si necesitas personalizaciones avanzadas.

2. **Los assets del sitio original** (CSS, JS, imágenes) deben ir en la carpeta `assets/` correspondiente.

3. **El archivo `screenshot.png`** es un placeholder. Reemplázalo con una captura real de tu sitio (1200x900px).

4. **Permisos recomendados:**
   - Carpetas: `755`
   - Archivos: `644`

5. **Para desarrollo local**, usa:
   - Local by Flywheel
   - XAMPP
   - MAMP
   - Docker con WordPress

## 🔗 Referencias Rápidas

- WordPress Codex: https://codex.wordpress.org/
- Theme Handbook: https://developer.wordpress.org/themes/
- Template Hierarchy: https://developer.wordpress.org/themes/basics/template-hierarchy/

---

**Última actualización**: 2024
**Versión del tema**: 1.0.0
