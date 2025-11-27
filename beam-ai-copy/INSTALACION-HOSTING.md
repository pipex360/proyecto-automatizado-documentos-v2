# 🚀 Instalación en Hosting - Guía Paso a Paso

Esta guía te llevará desde cero hasta tener tu sitio funcionando en tu hosting.

---

## 📦 MÉTODO 1: Subir vía WordPress Admin (RECOMENDADO - Más Fácil)

### ✅ **Paso 1: Preparar el Tema**

Necesitas el archivo `beam-ai-theme.zip` que ya está creado en:
```
beam-ai-copy/wordpress-theme/beam-ai-theme.zip
```

Si no existe, créalo:
```bash
# En tu computadora, desde la carpeta del proyecto:
cd beam-ai-copy/wordpress-theme
zip -r beam-ai-theme.zip beam-ai-theme/
```

O en Windows:
```
1. Navega a: beam-ai-copy/wordpress-theme/
2. Click derecho en la carpeta "beam-ai-theme"
3. Enviar a → Carpeta comprimida (ZIP)
4. Renombra a: beam-ai-theme.zip
```

---

### ✅ **Paso 2: Acceder a WordPress Admin**

1. Abre tu navegador
2. Ve a: `https://tudominio.com/wp-admin`
3. Ingresa tu usuario y contraseña
4. Click en **Iniciar sesión**

---

### ✅ **Paso 3: Subir el Tema**

1. En el menú izquierdo, ve a **Apariencia → Temas**

2. Click en el botón **Añadir nuevo** (parte superior)

3. Click en **Subir tema**

4. Click en **Seleccionar archivo**

5. Busca y selecciona `beam-ai-theme.zip`

6. Click en **Instalar ahora**

7. Espera a que suba (puede tardar 30 segundos - 2 minutos)

8. Cuando veas "Tema instalado correctamente", click en **Activar**

---

### ✅ **Paso 4: Crear Página de Inicio**

1. Ve a **Páginas → Añadir nueva**

2. **Título**: Escribe "Inicio" (o "Home")

3. En la barra derecha, busca **Atributos de página**

4. En **Plantilla**, selecciona: **"Página de Inicio - Beam AI Completa"**

5. Click en **Publicar**

---

### ✅ **Paso 5: Configurar como Página Principal**

1. Ve a **Ajustes → Lectura**

2. En "Muestra la página de inicio", selecciona: **"Una página estática"**

3. En **Página de inicio**, selecciona: **"Inicio"**

4. Click en **Guardar cambios**

---

### ✅ **Paso 6: Verificar que Funciona**

1. Abre una nueva pestaña

2. Ve a: `https://tudominio.com`

3. ¡Deberías ver tu sitio con el diseño moderno funcionando! 🎉

---

## 🎨 **Paso 7: Personalizar el Contenido**

### **A. Cambiar Logo**

1. Ve a **Apariencia → Personalizar**
2. Click en **Identidad del sitio**
3. **Logotipo** → Click en **Seleccionar logo**
4. Sube tu logo (PNG recomendado, 400x100px)
5. Ajusta si es necesario
6. Click en **Publicar**

### **B. Cambiar Textos**

1. En **Apariencia → Personalizar**
2. Busca las opciones que empiezan con "Beam..."
3. Cambia los textos por los tuyos
4. Click en **Publicar**

### **C. Configurar Menú**

1. Ve a **Apariencia → Menús**
2. Click en **crear un menú nuevo**
3. Nombre: "Menú Principal"
4. Agrega páginas desde la izquierda
5. En "Posiciones del menú", marca **"Menú Principal"**
6. **Guardar menú**

---

## ✅ ¡LISTO! Tu sitio está funcionando 🎉

---

---

## 📦 MÉTODO 2: Subir vía FTP (Alternativo)

### **Paso 1: Descargar Cliente FTP**

Descarga e instala FileZilla: https://filezilla-project.org/download.php?type=client

### **Paso 2: Obtener Credenciales FTP**

Desde tu panel de hosting (cPanel, Plesk, etc.):

1. Busca la sección **"FTP"** o **"Cuentas FTP"**
2. Anota o copia:
   - **Servidor/Host**: ftp.tudominio.com
   - **Usuario**: tu_usuario_ftp
   - **Contraseña**: tu_contraseña_ftp
   - **Puerto**: 21 (normalmente)

### **Paso 3: Conectar con FileZilla**

1. Abre FileZilla

2. En la parte superior, completa:
   ```
   Servidor: ftp.tudominio.com
   Usuario: tu_usuario_ftp
   Contraseña: tu_contraseña_ftp
   Puerto: 21
   ```

3. Click en **Conexión rápida**

4. Si aparece un aviso de certificado, marca "Confiar siempre" y acepta

### **Paso 4: Navegar a la Carpeta de Temas**

En FileZilla verás 2 paneles:

**Panel Izquierdo (tu computadora):**
- Navega a donde tienes el proyecto
- Ve a: `beam-ai-copy/wordpress-theme/`

**Panel Derecho (tu servidor):**
- Navega a: `/public_html/wp-content/themes/`
- (O puede ser `/htdocs/` o `/www/` dependiendo del hosting)

### **Paso 5: Subir el Tema**

1. En el panel izquierdo, selecciona la carpeta **"beam-ai-theme"** completa

2. Click derecho → **Subir**

3. Espera a que todos los archivos suban (puede tardar 2-5 minutos)

4. Verifica que la carpeta `beam-ai-theme` ahora esté en:
   ```
   /public_html/wp-content/themes/beam-ai-theme/
   ```

### **Paso 6: Activar en WordPress**

1. Ve a WordPress Admin: `https://tudominio.com/wp-admin`

2. **Apariencia → Temas**

3. Busca "Beam AI Clone"

4. Click en **Activar**

### **Paso 7: Continuar con Pasos 4-7 del Método 1**

Sigue los pasos 4-7 del Método 1 para configurar la página de inicio y personalizar.

---

---

## 📦 MÉTODO 3: Subir vía cPanel File Manager

### **Paso 1: Acceder a cPanel**

1. Ve a: `https://tudominio.com/cpanel`
   (o `https://tudominio.com:2083`)

2. Ingresa usuario y contraseña de cPanel

### **Paso 2: Abrir File Manager**

1. En cPanel, busca la sección **"Archivos"**

2. Click en **"Administrador de archivos"** o **"File Manager"**

### **Paso 3: Navegar a Themes**

1. En el panel izquierdo, navega a:
   ```
   public_html → wp-content → themes
   ```

2. O en algunos hostings:
   ```
   htdocs → wp-content → themes
   ```

### **Paso 4: Subir el ZIP**

1. Click en el botón **"Upload"** (Subir) en la barra superior

2. Se abrirá una nueva pestaña

3. Click en **"Seleccionar archivo"**

4. Selecciona `beam-ai-theme.zip`

5. Espera a que suba (verás una barra de progreso)

6. Cuando llegue al 100%, cierra esa pestaña

### **Paso 5: Extraer el ZIP**

1. Vuelve al File Manager

2. Busca el archivo `beam-ai-theme.zip` en la carpeta `themes`

3. Click derecho en `beam-ai-theme.zip`

4. Selecciona **"Extract"** (Extraer)

5. En la ventana que aparece, verifica que la ruta sea:
   ```
   /public_html/wp-content/themes/
   ```

6. Click en **"Extract File(s)"**

7. Espera a que termine (verás "Extraction Results")

8. Click en **"Close"**

### **Paso 6: Eliminar el ZIP (Opcional)**

1. Click derecho en `beam-ai-theme.zip`

2. Selecciona **"Delete"** (Eliminar)

3. Confirma

### **Paso 7: Activar en WordPress**

Continúa con el Paso 2 del Método 1 (Activar tema en WordPress Admin)

---

---

## 🔍 Verificación de Instalación Correcta

### ✅ **Checklist Post-Instalación**

Verifica que todo esté correcto:

```
□ Tema "Beam AI Clone" aparece en Apariencia → Temas
□ Tema está activado (tiene un indicador "Activo")
□ Página "Inicio" creada con template correcto
□ Configurado como página principal en Ajustes → Lectura
□ Al visitar tudominio.com se ve el diseño moderno
□ El hero section tiene gradiente morado/azul
□ Las animaciones funcionan al hacer scroll
□ El sitio se ve bien en móvil (prueba con F12)
□ El header se queda fijo al hacer scroll
□ Los botones tienen efectos hover
```

---

## ⚠️ Solución de Problemas Comunes

### **Problema 1: "El tema está dañado"**

**Causa**: El ZIP no se subió completo o se corrompió

**Solución**:
1. Elimina el tema de WordPress
2. Vuelve a crear el ZIP
3. Verifica el tamaño del archivo (debe ser ~500KB-1MB)
4. Sube de nuevo

---

### **Problema 2: "Error al subir. El tipo de archivo no es compatible"**

**Causa**: Restricciones de seguridad del hosting

**Solución**:
1. Usa el Método 2 (FTP) o Método 3 (cPanel)
2. O contacta a tu hosting para que permitan subir ZIPs de temas

---

### **Problema 3: "El sitio se ve sin estilos (solo texto)"**

**Causa**: Los archivos CSS no se cargaron correctamente

**Solución**:
1. Verifica que exista: `wp-content/themes/beam-ai-theme/assets/css/modern-saas.css`
2. Verifica permisos (deben ser 644 para archivos, 755 para carpetas)
3. Vacía caché del navegador (Ctrl+F5)
4. Si usas plugin de caché, límpialo

---

### **Problema 4: "Las animaciones no funcionan"**

**Causa**: JavaScript no se cargó

**Solución**:
1. Verifica que exista: `wp-content/themes/beam-ai-theme/assets/js/animations.js`
2. Abre consola del navegador (F12) y busca errores
3. Verifica que jQuery esté cargado (WordPress lo incluye por defecto)

---

### **Problema 5: "Página 404 o página en blanco"**

**Causa**: Los permalinks no están configurados

**Solución**:
1. Ve a **Ajustes → Enlaces permanentes**
2. Selecciona cualquier opción (ej: "Nombre de entrada")
3. **Guardar cambios**
4. Prueba de nuevo

---

### **Problema 6: "Límite de subida excedido"**

**Causa**: Tu hosting tiene límite de tamaño de subida

**Solución**:
1. Usa Método 2 (FTP) - no tiene límite
2. O Método 3 (cPanel File Manager)
3. O contacta a tu hosting para aumentar el límite

---

## 📊 Permisos Correctos (Si tienes problemas)

Los permisos deben ser:

```
Carpetas: 755
Archivos: 644
```

Para configurarlos vía FTP:
1. Click derecho en la carpeta `beam-ai-theme`
2. **Permisos de archivo**
3. Valor numérico: **755** para carpetas
4. Marca "Recurrir en subdirectorios"
5. Selecciona "Aplicar solo a directorios"
6. OK

Repite para archivos con valor **644** y "Aplicar solo a archivos"

---

## 🚀 Optimización Post-Instalación

### **1. Instalar Plugins Útiles**

Recomendados:
- **Yoast SEO** - Para optimización SEO
- **Autoptimize** - Para optimizar CSS/JS
- **Smush** - Para optimizar imágenes
- **WP Super Cache** - Para caché y velocidad

### **2. Configurar SSL (HTTPS)**

Si tu hosting tiene SSL:
1. En cPanel, busca **"SSL/TLS"**
2. Instala certificado SSL (muchos hostings ofrecen Let's Encrypt gratis)
3. En WordPress, ve a **Ajustes → Generales**
4. Cambia URLs a `https://tudominio.com`
5. Guarda

### **3. Configurar Backup**

Instala plugin **UpdraftPlus**:
1. **Plugins → Añadir nuevo**
2. Busca "UpdraftPlus"
3. Instala y activa
4. Configura backup automático

---

## 📱 Probar en Diferentes Dispositivos

### **Usando Chrome DevTools (F12)**

1. Presiona **F12** en Chrome
2. Click en el ícono de móvil (arriba izquierda)
3. Prueba diferentes tamaños:
   - iPhone SE (375px)
   - iPhone 12 Pro (390px)
   - iPad (768px)
   - iPad Pro (1024px)

### **Usando Sitios Online**

- https://responsivedesignchecker.com/
- https://www.browserstack.com/responsive

---

## ✅ Checklist Final

Antes de considerar el sitio terminado:

```
□ Tema instalado y activo
□ Página de inicio configurada
□ Logo subido
□ Textos personalizados
□ Menú configurado
□ Probado en móvil
□ Probado en diferentes navegadores (Chrome, Firefox, Safari)
□ SSL configurado (HTTPS)
□ Google Analytics agregado (opcional)
□ SEO básico configurado (Yoast)
□ Backup configurado
□ Imágenes optimizadas
□ Velocidad de carga aceptable (< 3 segundos)
```

---

## 🎓 Recursos Adicionales

### **Documentación del Proyecto**

- `GUIA-PERSONALIZACION.md` - Cómo editar el contenido
- `README.md` - Guía completa del proyecto
- `INSTRUCCIONES-RAPIDAS.md` - Quick start

### **Soporte de WordPress**

- https://wordpress.org/support/
- https://wordpress.org/documentation/

### **Tutoriales en Video** (Genéricos de WordPress)

- YouTube: "Cómo instalar tema WordPress"
- YouTube: "WordPress para principiantes"

---

## 📞 ¿Necesitas Ayuda?

### **Si algo no funciona:**

1. **Revisa esta guía** - Encuentra tu problema en "Solución de Problemas"
2. **Verifica los requisitos** - WordPress 6.0+, PHP 7.4+
3. **Contacta a tu hosting** - Ellos conocen las especificaciones de tu servidor

### **Información a tener lista si contactas soporte:**

- Versión de WordPress
- Versión de PHP
- Nombre del hosting
- Mensaje de error exacto (si hay)
- Captura de pantalla del problema

---

## 🎉 ¡Felicidades!

Si llegaste hasta aquí y todo funciona, ¡tienes un sitio web moderno y profesional! 🚀

**Siguiente paso**: Personaliza el contenido con tu información usando `GUIA-PERSONALIZACION.md`

---

**Última actualización**: 2024
**Versión**: 1.0.0
