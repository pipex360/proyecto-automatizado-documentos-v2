# 📤 Guía Detallada - Subir Tema por FTP con FileZilla

## ✅ Paso 1: Descargar FileZilla

1. Ve a: https://filezilla-project.org/download.php?type=client
2. Descarga la versión para tu sistema operativo
3. Instala FileZilla (siguiente, siguiente, instalar)

---

## ✅ Paso 2: Obtener Credenciales FTP

Necesitas estos datos de tu hosting:

```
📝 Host/Servidor:  ftp.tudominio.com (o IP del servidor)
👤 Usuario:        tu_usuario_ftp
🔑 Contraseña:     tu_contraseña_ftp
🔌 Puerto:         21 (normalmente)
```

### **¿Dónde encontrar estas credenciales?**

#### **Si tienes cPanel:**
1. Accede a cPanel: `https://tudominio.com/cpanel`
2. Busca sección **"Archivos"**
3. Click en **"Cuentas FTP"** o **"FTP Accounts"**
4. Ahí verás tus credenciales FTP

#### **Si tienes otro panel:**
- Busca "FTP" en tu panel de hosting
- O contacta a tu proveedor de hosting

#### **Hostings comunes:**

**Hostinger:**
- Panel hPanel → Archivos → Administrador FTP
- Usuario: formato `u123456789`
- Host: `ftp.hostinger.com`

**SiteGround:**
- Site Tools → Devs → Administrador FTP
- Host: `tudominio.com` o IP del servidor

**GoDaddy:**
- cPanel → Cuentas FTP
- Host: formato `ftp.tudominio.com`

**BlueHost:**
- cPanel → FTP Accounts
- Host: `ftp.tudominio.com`

---

## ✅ Paso 3: Conectar con FileZilla

1. **Abre FileZilla**

2. En la parte superior verás 4 campos:
   ```
   [Servidor]  [Usuario]  [Contraseña]  [Puerto]
   ```

3. **Completa los datos:**
   ```
   Servidor:    ftp.tudominio.com
   Usuario:     tu_usuario_ftp
   Contraseña:  tu_contraseña_ftp
   Puerto:      21
   ```

4. **Click en "Conexión rápida"**

5. Si aparece un aviso de certificado:
   - Marca ✓ "Confiar siempre en este certificado"
   - Click en **"Aceptar"**

6. Deberías ver:
   - ✅ Mensaje: "Directorio listado correctamente"
   - ✅ Archivos de tu servidor en el panel derecho

---

## ✅ Paso 4: Navegar a la Carpeta Correcta

### **En FileZilla verás 2 paneles:**

```
┌─────────────────────┬─────────────────────┐
│   TU COMPUTADORA    │    TU SERVIDOR      │
│   (Panel Izquierdo) │  (Panel Derecho)    │
└─────────────────────┴─────────────────────┘
```

### **Panel DERECHO (servidor):**

1. Busca y navega a la carpeta de WordPress:

   **Ruta común 1:**
   ```
   public_html/wp-content/themes/
   ```

   **Ruta común 2:**
   ```
   htdocs/wp-content/themes/
   ```

   **Ruta común 3:**
   ```
   www/wp-content/themes/
   ```

2. Haz **doble click** en cada carpeta para entrar:
   ```
   Doble click en: public_html
   Doble click en: wp-content
   Doble click en: themes
   ```

3. Deberías ver otros temas de WordPress (ej: twentytwentyfour)

### **Panel IZQUIERDO (tu computadora):**

1. Navega a donde tienes el proyecto

2. Ve a:
   ```
   beam-ai-copy/wordpress-theme/
   ```

3. Deberías ver la carpeta `beam-ai-theme`

---

## ✅ Paso 5: Subir la Carpeta del Tema

### **Método A: Arrastrar y Soltar (Más Fácil)**

1. En el **panel IZQUIERDO**, selecciona la carpeta `beam-ai-theme`

2. **Click derecho** en `beam-ai-theme`

3. Selecciona **"Subir"** o **"Upload"**

4. También puedes **arrastrarla** directamente al panel derecho

5. Verás una ventana de progreso:
   ```
   Transfiriendo archivo 1 de 15...
   Archivo: style.css
   Progreso: [████████░░] 80%
   ```

6. **Espera** a que termine (puede tardar 2-5 minutos)

7. Cuando termine, verás en el panel derecho:
   ```
   /public_html/wp-content/themes/beam-ai-theme/
   ```

### **Método B: Subir Archivo por Archivo (Más Control)**

Si el Método A falla, sube archivo por archivo:

1. Crea primero la carpeta en el servidor:
   - **Panel derecho** → Click derecho → **"Crear directorio"**
   - Nombre: `beam-ai-theme`
   - Enter

2. **Doble click** en `beam-ai-theme` para entrar

3. Sube los archivos principales:
   - Selecciona `style.css` en panel izquierdo
   - Click derecho → **"Subir"**
   - Repite para cada archivo

4. Para las carpetas (`assets`, `inc`, `templates`):
   - Crea cada carpeta en el servidor (panel derecho)
   - Entra a la carpeta
   - Sube los archivos de esa carpeta

---

## ✅ Paso 6: Verificar que se Subió Todo

### **En el panel DERECHO, verifica que exista:**

```
📁 themes/beam-ai-theme/
   ├── 📄 style.css              ✓
   ├── 📄 functions.php          ✓
   ├── 📄 index.php              ✓
   ├── 📄 header.php             ✓
   ├── 📄 footer.php             ✓
   ├── 📄 page.php               ✓
   ├── 📄 single.php             ✓
   ├── 📄 sidebar.php            ✓
   ├── 📄 screenshot.png         ✓
   │
   ├── 📁 assets/
   │   ├── 📁 css/
   │   │   ├── modern-saas.css  ✓
   │   │   └── custom.css       ✓
   │   ├── 📁 js/
   │   │   ├── animations.js    ✓
   │   │   └── custom.js        ✓
   │   ├── 📁 images/           ✓
   │   └── 📁 fonts/            ✓
   │
   ├── 📁 inc/
   │   ├── template-tags.php    ✓
   │   └── template-functions.php ✓
   │
   └── 📁 templates/
       └── page-home.php        ✓
```

### **Contar archivos:**

En el panel derecho, deberías ver **al menos 15 archivos** dentro de `beam-ai-theme/`

---

## ✅ Paso 7: Verificar Permisos (Importante)

Los permisos deben ser correctos para que funcione:

1. **En el panel derecho**, click derecho en la carpeta `beam-ai-theme`

2. Selecciona **"Permisos de archivo"** o **"File permissions"**

3. Configura:
   ```
   Valor numérico: 755

   ✓ Recurrir en subdirectorios
   ✓ Aplicar solo a directorios
   ```

4. Click **OK**

5. Repite para archivos:
   ```
   Valor numérico: 644

   ✓ Recurrir en subdirectorios
   ✓ Aplicar solo a archivos
   ```

6. Click **OK**

---

## ✅ Paso 8: Activar el Tema en WordPress

Ahora que está en el servidor:

1. Abre tu navegador

2. Ve a: `https://tudominio.com/wp-admin`

3. Ingresa usuario y contraseña

4. **Apariencia → Temas**

5. Busca **"Beam AI Clone"**

6. Click en **"Activar"**

7. ¡Deberías ver un mensaje de éxito!

---

## ✅ Paso 9: Configurar Página de Inicio

1. **Páginas → Añadir nueva**

2. Título: `Inicio`

3. En la barra derecha:
   - **Atributos de página**
   - **Plantilla:** Selecciona "Página de Inicio - Beam AI Completa"

4. Click **Publicar**

5. Ve a **Ajustes → Lectura**

6. Selecciona:
   - ✓ "Una página estática"
   - Página de inicio: "Inicio"

7. **Guardar cambios**

---

## ✅ Paso 10: ¡Ver tu Sitio!

1. Abre una nueva pestaña

2. Ve a: `https://tudominio.com`

3. Deberías ver:
   - ✅ Hero section con gradiente morado
   - ✅ Contadores animados al scroll
   - ✅ Features con iconos
   - ✅ Testimonios
   - ✅ CTA final
   - ✅ Efectos al hacer scroll

4. Prueba hacer scroll hacia abajo para ver las animaciones

5. Presiona **F12** → Click en ícono móvil → Probar responsive

---

## 🎉 ¡LISTO!

Si ves todo funcionando:
- ✅ El tema está correctamente instalado
- ✅ Los estilos se cargan
- ✅ Las animaciones funcionan
- ✅ Es responsive

### **Siguiente paso:**

Lee: **`GUIA-PERSONALIZACION.md`** para cambiar:
- Textos
- Logo
- Imágenes
- Colores
- Menús

---

## ⚠️ Problemas Comunes

### **Problema 1: No veo "Beam AI Clone" en los temas**

**Causa:** Los archivos no se subieron correctamente

**Solución:**
1. Vuelve a FileZilla
2. Verifica que la carpeta `beam-ai-theme` esté en:
   ```
   /public_html/wp-content/themes/beam-ai-theme/
   ```
3. Verifica que dentro haya archivos (style.css, functions.php, etc.)

---

### **Problema 2: El sitio se ve sin estilos**

**Causa:** Los archivos CSS no se cargaron

**Solución:**
1. Verifica que exista:
   ```
   themes/beam-ai-theme/assets/css/modern-saas.css
   ```
2. En FileZilla, verifica permisos (644 para archivos)
3. Limpia caché del navegador: **Ctrl+F5**

---

### **Problema 3: Las animaciones no funcionan**

**Causa:** JavaScript no se cargó

**Solución:**
1. Verifica que exista:
   ```
   themes/beam-ai-theme/assets/js/animations.js
   ```
2. Abre consola del navegador (F12) y busca errores en rojo
3. Verifica permisos del archivo (644)

---

### **Problema 4: "Failed to upload"**

**Causa:** Problemas de conexión o permisos

**Solución:**
1. Verifica que estás conectado (mira la barra de estado de FileZilla)
2. Intenta subir de nuevo
3. Si persiste, sube archivo por archivo en lugar de la carpeta completa

---

### **Problema 5: No puedo conectar con FileZilla**

**Causa:** Credenciales incorrectas o firewall

**Solución:**
1. Verifica usuario y contraseña FTP
2. Intenta cambiar puerto de 21 a 22 (SFTP)
3. Desactiva temporalmente firewall/antivirus
4. Contacta a tu hosting para verificar que FTP esté habilitado

---

## 📊 Checklist Final

Antes de dar por terminado:

```
□ Conectado a FileZilla con credenciales FTP
□ Navegado a /public_html/wp-content/themes/
□ Subida carpeta beam-ai-theme completa
□ Verificados todos los archivos (15 archivos mínimo)
□ Configurados permisos (755 carpetas, 644 archivos)
□ Tema activado en WordPress Admin
□ Página "Inicio" creada con template correcto
□ Configurada como página principal
□ Visitado el sitio y verificado funcionamiento
□ Animaciones funcionan al hacer scroll
□ Responsive funciona (probado con F12)
□ No hay errores en la consola
```

---

## 🎓 Video Tutorial (Si necesitas ayuda visual)

Busca en YouTube:
- "Como subir tema WordPress por FTP FileZilla"
- "FileZilla tutorial español"
- "Subir archivos WordPress FTP"

---

**¿Listo para empezar?** 🚀

Sigue estos pasos en orden y tendrás tu sitio funcionando.
