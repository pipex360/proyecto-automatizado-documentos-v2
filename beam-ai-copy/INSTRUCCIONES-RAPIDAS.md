# ⚡ Instrucciones Rápidas - Clonar beam.ai/es a WordPress

## 🎯 Proceso en 5 Minutos

### 1️⃣ Descargar el sitio (2 minutos)

**Método más simple - Con tu navegador:**
1. Abre https://beam.ai/es/
2. `Ctrl+S` (o `Cmd+S` en Mac)
3. Selecciona "Página web, completa"
4. Guarda en tu computadora

### 2️⃣ Preparar WordPress (1 minuto)

Si ya tienes WordPress instalado, sáltate esto. Si no:

```bash
# Descarga WordPress
wget https://wordpress.org/latest.tar.gz
tar -xzf latest.tar.gz

# O usa instalador local: Local by Flywheel, XAMPP, MAMP
```

### 3️⃣ Instalar el tema (1 minuto)

```bash
# Copia el tema a WordPress
cp -r wordpress-theme/beam-ai-theme /ruta/a/wordpress/wp-content/themes/

# En WordPress:
# 1. Ve a Apariencia → Temas
# 2. Activa "Beam AI Clone"
```

### 4️⃣ Copiar archivos descargados (1 minuto)

```bash
# Desde la carpeta donde guardaste el sitio
cd "beam.ai (Archivo web, completo)"  # O el nombre que tenga

# Copia los archivos al tema
cp -r beam.ai_files/* /ruta/a/wordpress/wp-content/themes/beam-ai-theme/assets/
```

O manualmente:
1. Abre la carpeta descargada
2. Busca carpetas: `css/`, `js/`, `images/`
3. Cópialas a: `wp-content/themes/beam-ai-theme/assets/`

### 5️⃣ Configurar WordPress (30 segundos)

1. **Crear página de inicio:**
   - Páginas → Añadir nueva
   - Título: "Inicio"
   - Template: "Página de Inicio - Beam AI"
   - Publicar

2. **Configurar como página principal:**
   - Ajustes → Lectura
   - Página de inicio: "Inicio"
   - Guardar

## ✅ ¡Listo!

Tu sitio clon de beam.ai/es ya está funcionando.

## 🎨 Personalización Rápida

### Cambiar logo:
`Apariencia → Personalizar → Identidad del sitio → Logo`

### Crear menú:
```
Apariencia → Menús
1. Crear nuevo menú
2. Agregar páginas
3. Asignar a "Menú Principal"
```

### Cambiar botón CTA:
`Apariencia → Personalizar → Configuración Beam AI`

## 🔧 Si algo no funciona

### Estilos no se ven:
```bash
# Verifica que estos archivos existen:
ls wp-content/themes/beam-ai-theme/assets/css/
ls wp-content/themes/beam-ai-theme/assets/js/
ls wp-content/themes/beam-ai-theme/assets/images/
```

### Imágenes no cargan:
```bash
# Cambia permisos
chmod -R 755 wp-content/themes/beam-ai-theme/assets/
```

### Página en blanco:
```bash
# Activa debug en wp-config.php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);

# Revisa errores en:
wp-content/debug.log
```

## 📱 Probar el sitio

1. Abre tu sitio en el navegador
2. Presiona `F12` para abrir DevTools
3. Click en el ícono de móvil
4. Prueba diferentes tamaños

## 🚀 Optimización (Opcional)

### Instalar plugins:
```
1. Autoptimize (optimización)
2. Yoast SEO (SEO)
3. Smush (optimizar imágenes)
```

### Optimizar imágenes:
```bash
# Si tienes ImageMagick instalado
cd wp-content/themes/beam-ai-theme/assets/images/
mogrify -resize 1920x1920\> -quality 85 *.jpg
optipng *.png
```

## 📋 Checklist Final

- [ ] Tema activado ✓
- [ ] Archivos copiados (CSS, JS, imágenes) ✓
- [ ] Página de inicio creada ✓
- [ ] Menú configurado ✓
- [ ] Probado en móvil ✓
- [ ] Imágenes cargan correctamente ✓
- [ ] Links funcionan ✓

## 🎓 Siguiente Nivel

Para personalización avanzada, lee:
- **[README.md](README.md)** - Documentación completa
- **[GUIA-COMPLETA.md](GUIA-COMPLETA.md)** - Guía detallada paso a paso

---

**¿Listo en 5 minutos?** ⏱️ ¡Comienza ahora! 🚀
