# Proyecto CRUD Laravel

Este proyecto es una aplicación web desarrollada con el framework [Laravel](https://laravel.com/). Sigue las instrucciones a continuación para configurar y ejecutar el proyecto en tu entorno local.

## Requisitos previos

Asegúrate de tener instalado el siguiente software en tu equipo:

*   [PHP](https://www.php.net/) >= 8.1
*   [Composer](https://getcomposer.org/)
*   [Node.js](https://nodejs.org/) y NPM
*   Un servidor de base de datos MySQL (por ejemplo, a través de [XAMPP](https://www.apachefriends.org/es/index.html) o MySQL Server directo)

## Instalación y Configuración

Sigue estos pasos detallados para levantar el proyecto:

### 1. Clonar el repositorio

Si aún no has clonado el proyecto, hazlo con el siguiente comando:

```bash
git clone <URL_DEL_REPOSITORIO>
cd crudlaravel
```

### 2. Instalar dependencias de PHP

Ejecuta el siguiente comando para instalar las librerías necesarias del backend:

```bash
composer install
```

### 3. Configurar el entorno

Si el archivo `.env` no existe, crea una copia del archivo de ejemplo:

Windows (PowerShell):
```powershell
copy .env.example .env
```

Linux/Mac:
```bash
cp .env.example .env
```

Genera la clave de encriptación de la aplicación:

```bash
php artisan key:generate
```

### 4. Configurar la Base de Datos

1.  Abre el archivo `.env` en un editor de texto o IDE.
2.  Busca la sección de configuración de base de datos y ajústala según tu entorno local (ejemplo para XAMPP):

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=crudlaravel
    DB_USERNAME=root
    DB_PASSWORD=
    ```

3.  **Importante:** Crea una base de datos vacía llamada `crudlaravel` (o el nombre que hayas puesto en `DB_DATABASE`) usando tu gestor de base de datos favorito (como phpMyAdmin o MySQL Workbench).

### 5. Ejecutar Migraciones

Una vez configurada y creada la base de datos, ejecuta las migraciones para crear las tablas:

```bash
php artisan migrate
```

### 6. Instalar dependencias de Frontend

Instala las dependencias de Node.js necesarias para los estilos y scripts:

```bash
npm install
```

### 7. Ejecutar el proyecto

Para trabajar en el proyecto necesitas correr dos procesos simultáneamente en terminales separadas:

**Terminal 1 (Servidor de desarrollo de Laravel):**
```bash
php artisan serve
```
Esto iniciará la aplicación en `http://localhost:8000`.

**Terminal 2 (Compilación de activos con Vite):**
```bash
npm run dev
```
Esto se encarga de procesar y actualizar los archivos CSS y JS en tiempo real.

¡Listo! Ahora puedes acceder a la aplicación en tu navegador.
