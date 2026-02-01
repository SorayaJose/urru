# 🚀 Guía de Despliegue en cPanel

## 📋 Pasos previos (Ya completados)

✅ Dependencias compiladas: `composer install --no-dev`
✅ Assets compilados: `npm run build`
✅ Archivo `.env.production` creado

## 1️⃣ Configurar cPanel

### A) Cambiar versión PHP
- Accede a tu cPanel
- Busca **"Select PHP Version"** o **"MultiPHP Manager"**
- Selecciona **PHP 8.1** o **PHP 8.2**

### B) Crear Base de Datos MySQL
1. En cPanel → **MySQL Databases**
2. Crear nueva base de datos (ej: `usuario_urru`)
3. Crear nuevo usuario MySQL
4. Asignar **TODOS LOS PRIVILEGIOS** al usuario sobre la base de datos
5. **ANOTA** estos datos:
   - Nombre de BD: `_______________________`
   - Usuario: `_______________________`
   - Contraseña: `_______________________`
   - Host: `localhost` (normalmente)

## 2️⃣ Configurar .env.production

Antes de subir, edita `.env.production` con tus datos:

```env
APP_URL=https://tudominio.com  # Tu dominio real
DB_DATABASE=usuario_urru       # Nombre de tu BD
DB_USERNAME=usuario_mysql      # Usuario MySQL
DB_PASSWORD=tu_contraseña      # Contraseña MySQL
```

## 3️⃣ Estructura en el servidor

La estructura correcta en cPanel debe ser:

```
/home/usuario/
├── public_html/              ← Carpeta raíz del sitio
│   ├── index.php            ← Este será el de Laravel/public
│   ├── css/
│   ├── js/
│   └── images/
└── urru_app/                 ← Carpeta FUERA de public_html
    ├── app/
    ├── bootstrap/
    ├── config/
    ├── database/
    ├── resources/
    ├── routes/
    ├── storage/
    ├── vendor/
    └── .env
```

## 4️⃣ Subir archivos por FTP

### A) Carpeta principal (FUERA de public_html)

Crea carpeta `urru_app` en `/home/usuario/` y sube:
- `app/`
- `bootstrap/`
- `config/`
- `database/`
- `resources/`
- `routes/`
- `storage/`
- `vendor/` (toda la carpeta con dependencias)
- `artisan`
- `composer.json`
- `composer.lock`
- `.env.production` → **RENOMBRAR a `.env`** en el servidor

### B) Carpeta pública (DENTRO de public_html)

Sube TODO el contenido de tu carpeta `public/`:
- `index.php`
- `build/` (los assets compilados)
- `images/`
- `.htaccess`

**IMPORTANTE:** Sube el CONTENIDO de `public/`, no la carpeta completa.

## 5️⃣ Editar index.php en el servidor

Una vez subido, edita `/public_html/index.php`:

**BUSCA estas líneas:**
```php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
```

**CÁMBIALA por:**
```php
require __DIR__.'/../urru_app/vendor/autoload.php';
$app = require_once __DIR__.'/../urru_app/bootstrap/app.php';
```

## 6️⃣ Configurar permisos (vía FTP o cPanel File Manager)

Permisos necesarios:
- `storage/` → 755 o 775 (recursivo)
- `storage/logs/` → 755 o 775
- `storage/framework/` → 755 o 775
- `bootstrap/cache/` → 755 o 775

En FileZilla: Click derecho → Propiedades → Permisos

## 7️⃣ Ejecutar migraciones

Si tienes acceso a Terminal en cPanel:

```bash
cd ~/urru_app
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Si NO tienes terminal, usa este archivo PHP temporal:

Crea `ejecutar.php` en `public_html/`:

```php
<?php
chdir('../urru_app');
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

//echo "Ejecutando migraciones...\n";
//$kernel->call('migrate', ['--force' => true]);
echo "Creando enlace de storage...\n";
$kernel->call('storage:link');
echo "Limpiando cache...\n";
$kernel->call('config:cache');
$kernel->call('route:cache');
$kernel->call('view:cache');
echo "¡Completado!";
```

Luego accede a: `https://tudominio.com/ejecutar.php`

**⚠️ BORRA `ejecutar.php` después de usarlo**

## 8️⃣ Verificación final

✅ Visita tu sitio: `https://tudominio.com`
✅ Prueba el login
✅ Verifica que las imágenes carguen
✅ Prueba crear un torneo

## 🔧 Problemas comunes

### Error 500
- Verifica permisos en `storage/` y `bootstrap/cache/`
- Revisa `.env` (credenciales de BD)

### Imágenes no cargan
- Ejecuta `php artisan storage:link` o crea el enlace manualmente

### "No application encryption key"
- Verifica que `.env` tenga `APP_KEY`
- Genera nueva: `php artisan key:generate`

### CSS/JS no cargan
- Verifica que `public/build/` se haya subido correctamente
- Revisa `APP_URL` en `.env`

## 📞 Ayuda adicional

Si algo falla, necesitaré ver:
- El error exacto que muestra
- Los logs en `storage/logs/laravel.log`
