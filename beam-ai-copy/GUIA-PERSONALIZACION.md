# 🎨 Guía de Personalización - Beam AI Theme

**¡El tema está listo y completamente funcional!** Ahora puedes cambiar fácilmente toda la información para que sea TU sitio.

---

## 🎯 Lo que tienes AHORA

✅ **Sitio completamente funcional** con diseño moderno
✅ **Efectos y animaciones** al scroll
✅ **Contenido de ejemplo** que puedes editar
✅ **100% responsive** (móviles, tablets, desktop)
✅ **Listo para personalizar** sin tocar código

---

## 📝 Cómo Editar el Contenido (Sin Tocar Código)

### **Paso 1: Activar el Tema**

1. Ve a **Apariencia → Temas**
2. Activa "Beam AI Clone"
3. ¡Ya tienes el diseño moderno funcionando!

### **Paso 2: Crear tu Página de Inicio**

1. Ve a **Páginas → Añadir nueva**
2. Título: "Inicio" (o el que quieras)
3. En "Atributos de página" → **Template**: Selecciona "Página de Inicio - Beam AI Completa"
4. Click en **Publicar**

5. Ve a **Ajustes → Lectura**
6. Selecciona "Una página estática"
7. **Página de inicio**: Selecciona "Inicio"
8. **Guardar cambios**

¡Listo! Ya tienes tu home page funcionando 🎉

---

## 🎨 Personalizar Textos y Enlaces

### **Opción A: Desde el Customizer** (Recomendado)

1. Ve a **Apariencia → Personalizar**
2. Busca la sección "Configuración Beam AI"
3. Ahí puedes cambiar:
   - Texto del botón CTA
   - URL del botón CTA
   - Logo del sitio
   - Colores (próximamente)

### **Opción B: Desde el Editor** (Para textos principales)

1. Ve a **Páginas → Inicio → Editar**
2. En el editor, puedes cambiar los textos que ves
3. Para los textos de cada sección, ve al Customizer

### **Textos Editables desde Customizer:**

| Elemento | Ubicación | Ejemplo |
|----------|-----------|---------|
| Título Hero | `beam_hero_title` | "Potencia tu negocio con IA" |
| Subtítulo Hero | `beam_hero_subtitle` | "La plataforma todo-en-uno..." |
| Botón CTA | `beam_cta_text` | "Comenzar ahora" |
| URL CTA | `beam_cta_url` | "#" o "https://..." |
| Título Features | `beam_features_title` | "Características potentes..." |
| Título Testimonios | `beam_testimonials_title` | "Lo que dicen nuestros clientes" |

---

## 🖼️ Cambiar Imágenes

### **Logo del Sitio:**

1. **Apariencia → Personalizar → Identidad del sitio**
2. Click en "Seleccionar logo"
3. Sube tu logo (preferible PNG con fondo transparente)
4. Ajusta tamaño si es necesario
5. **Publicar**

### **Imágenes de Features:**

Si quieres usar tus propias características:

1. Ve a **Features → Añadir nueva** (Custom Post Type)
2. Título: "Tu característica"
3. Contenido: Descripción
4. Imagen destacada: Tu icono/imagen
5. Publicar

El tema automáticamente mostrará tus features personalizadas en lugar de las de ejemplo.

### **Imágenes de Testimonios:**

1. Ve a **Testimonios → Añadir nuevo**
2. Título: Nombre del cliente
3. Contenido: El testimonio completo
4. Imagen destacada: Foto del cliente
5. En "Campos personalizados" agrega:
   - Campo: `company`
   - Valor: "Nombre de la empresa"
6. Publicar

---

## 🎯 Personalizar Secciones

### **Hero Section (Banner Principal)**

**Cambiar título:**
```
Apariencia → Personalizar → [Agregar sección Beam Hero]
Hero Title: "Tu título aquí"
```

Si no ves la opción en el Customizer, puedes editar directamente en:
`templates/page-home.php` línea 19

Ejemplo:
```php
<?php echo get_theme_mod('beam_hero_title', 'TU TÍTULO AQUÍ'); ?>
```

**Cambiar estadísticas (50,000 usuarios, 98%, 150 países):**

Edita `templates/page-home.php` líneas 38-49:
- Cambia `data-counter="50000"` por tu número
- Cambia "Usuarios activos" por tu texto

### **Features (Características)**

**Opción 1: Crear Features Personalizadas** (Recomendado)

1. Ve a **Features → Añadir nueva**
2. Agrega 6 características
3. El tema las mostrará automáticamente

**Opción 2: Editar las de Ejemplo**

Edita `templates/page-home.php` líneas 96-127:

```php
array(
    'icon' => '⚡',  // Cambia el emoji
    'title' => 'Tu título',  // Tu título
    'description' => 'Tu descripción'  // Tu descripción
),
```

### **Testimonios**

**Opción 1: Crear Testimonios** (Recomendado)

1. **Testimonios → Añadir nuevo**
2. Título: Nombre del cliente
3. Contenido: "El testimonio completo aquí"
4. Imagen destacada: Foto
5. Custom field `company`: "Nombre empresa"

**Opción 2: Editar los de Ejemplo**

Edita `templates/page-home.php` líneas 218-234

---

## 🎨 Cambiar Colores

### **Método Fácil** (Próximamente en Customizer)

Por ahora, edita `assets/css/modern-saas.css`:

```css
:root {
    --color-primary: #6366f1;  /* Cambia este color */
    --color-secondary: #8b5cf6;
    --color-accent: #ec4899;
}
```

### **Colores Disponibles:**

| Color | Uso | Valor por defecto |
|-------|-----|-------------------|
| `--color-primary` | Botones, links | #6366f1 (azul-morado) |
| `--color-secondary` | Acentos | #8b5cf6 (morado) |
| `--color-accent` | Highlights | #ec4899 (rosa) |

**Herramienta para elegir colores:**
- https://coolors.co/
- https://color.adobe.com/

---

## 📱 Cambiar Menús

### **Menú Principal (Header)**

1. **Apariencia → Menús**
2. **Crear un menú nuevo** → "Menú Principal"
3. Agrega páginas desde la izquierda
4. En "Posiciones del menú" → Marcar "Menú Principal"
5. **Guardar menú**

### **Menú Footer**

Igual que arriba pero selecciona posición "Menú Footer"

---

## ⚙️ Configuraciones Avanzadas

### **Cambiar Tipografía (Font)**

El tema usa **Inter** por defecto. Para cambiar:

1. Ve a Google Fonts: https://fonts.google.com/
2. Elige tu fuente
3. Copia el enlace `<link>`
4. Edita `functions.php` línea 102:

```php
wp_enqueue_style('beam-ai-fonts', 'TU-ENLACE-AQUI', array(), null);
```

5. Edita `assets/css/modern-saas.css` línea 38:

```css
--font-family-base: 'TU-FUENTE', sans-serif;
```

### **Agregar Google Analytics**

1. Instala plugin "Google Analytics for WordPress"
2. O agrega código en `header.php` antes de `</head>`

### **Agregar Favicon**

1. **Apariencia → Personalizar → Identidad del sitio**
2. **Icono del sitio** → Sube imagen 512x512px
3. **Publicar**

---

## 🚀 Contenido Editable - Referencia Rápida

### **Lo que puedes editar SIN código:**

✅ **Todos los textos** (desde Customizer o Editor)
✅ **Todas las imágenes** (Media Library)
✅ **Logo** (Customizer)
✅ **Menús** (Apariencia → Menús)
✅ **Colores básicos** (Customizer - próximamente)
✅ **Features** (Custom Post Type)
✅ **Testimonios** (Custom Post Type)
✅ **Enlaces de botones** (Customizer)

### **Lo que requiere edición de código (opcional):**

⚠️ **Colores avanzados** (CSS)
⚠️ **Tipografía** (CSS + functions.php)
⚠️ **Estructura de secciones** (Templates PHP)
⚠️ **Animaciones** (JavaScript)

---

## 📋 Checklist de Personalización

Usa esta lista para completar tu sitio:

- [ ] ✅ Activar tema "Beam AI Clone"
- [ ] ✅ Crear página "Inicio" con template
- [ ] ✅ Configurar como página principal
- [ ] ✅ Subir logo del sitio
- [ ] ✅ Cambiar título Hero
- [ ] ✅ Cambiar subtítulo Hero
- [ ] ✅ Cambiar texto botón CTA
- [ ] ✅ Cambiar URL botón CTA
- [ ] ✅ Crear Features personalizadas (o editar las de ejemplo)
- [ ] ✅ Crear Testimonios (o editar los de ejemplo)
- [ ] ✅ Configurar menú principal
- [ ] ✅ Configurar menú footer
- [ ] ✅ Cambiar colores (opcional)
- [ ] ✅ Agregar favicon
- [ ] ✅ Probar en móvil
- [ ] ✅ Publicar sitio

---

## 🎓 Tutoriales Paso a Paso

### **Tutorial 1: Cambiar Todos los Textos en 5 Minutos**

```
1. Apariencia → Personalizar
2. Busca cada campo que empiece con "beam_"
3. Cambia los textos
4. Click "Publicar"
```

### **Tutorial 2: Agregar tus Características**

```
1. Features → Añadir nueva
2. Título: "Velocidad increíble"
3. Contenido: "Descripción de la característica..."
4. Imagen destacada: Sube un icono
5. Publicar
6. Repite 6 veces (o las que necesites)
```

### **Tutorial 3: Cambiar el Color Principal**

```
1. Abre: assets/css/modern-saas.css
2. Busca: --color-primary: #6366f1;
3. Cambia por tu color (ej: #ff6b6b)
4. Guarda el archivo
5. Refresca tu sitio (Ctrl+F5)
```

---

## 💡 Tips y Trucos

### **Tip 1: Mantén el Contenido Corto**
- Títulos: Máximo 10 palabras
- Subtítulos: Máximo 20 palabras
- Descripciones: Máximo 2-3 líneas

### **Tip 2: Usa Imágenes Optimizadas**
- Formatos: JPG (fotos), PNG (logos/iconos), SVG (iconos vectoriales)
- Tamaño máximo: 500KB por imagen
- Dimensiones recomendadas:
  - Logo: 400x100px
  - Features: 64x64px
  - Testimonios: 100x100px
  - Hero background: 1920x1080px

### **Tip 3: Prueba en Móvil**
- Usa Chrome DevTools (F12)
- Click en ícono de móvil
- Prueba diferentes tamaños

### **Tip 4: Guarda Backups**
- Antes de cambios grandes, haz backup del tema
- Usa plugins como "UpdraftPlus"

---

## 🆘 Problemas Comunes y Soluciones

### **No se muestran mis Features personalizadas**

**Solución:**
1. Verifica que creaste al menos 1 Feature
2. Verifica que está publicada (no borrador)
3. Refresca la caché (Ctrl+F5)

### **Los colores no cambian**

**Solución:**
1. Vacía caché del navegador
2. Si usas plugin de caché, límpialo
3. Usa Ctrl+F5 para refrescar

### **Animaciones no funcionan**

**Solución:**
1. Verifica que JavaScript está activado
2. Abre consola (F12) y busca errores
3. Asegúrate de que `animations.js` se cargó

### **Móvil se ve mal**

**Solución:**
- El tema es responsive, si se ve mal puede ser:
  - Textos muy largos
  - Imágenes muy grandes
  - Contenido personalizado sin CSS responsive

---

## 📞 Próximos Pasos

1. **Personaliza todo el contenido** usando esta guía
2. **Prueba en diferentes dispositivos**
3. **Optimiza imágenes** antes de subir
4. **Configura SEO** (plugin Yoast SEO)
5. **Agrega Google Analytics**
6. **Haz backup** antes de hacer cambios grandes
7. **¡Lanza tu sitio!** 🚀

---

## 🎉 ¡Felicidades!

Tienes un sitio moderno, profesional y completamente funcional.
Ahora solo necesitas **personalizarlo con TU contenido**.

**¿Dudas?** Revisa los archivos README del proyecto para más información.

---

**Última actualización**: 2024
**Versión del tema**: 1.0.0
