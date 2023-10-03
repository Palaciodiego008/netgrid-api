# Proyecto de Gestión de Proyectos en Laravel

Este proyecto de gestión de proyectos desarrollado en Laravel ofrece una robusta solución para administrar proyectos y tareas de manera eficiente. A continuación, encontrarás información sobre cómo configurar, ejecutar y utilizar esta aplicación.

## Requisitos del Sistema

Antes de ejecutar la aplicación, asegúrate de que tu sistema cumpla con los siguientes requisitos:

- PHP 8.1
- Composer.
- MySQL.
- Node.js (necesario para compilar activos CSS/JS).
- Un servidor web (por ejemplo, Apache o Nginx).

## Configuración e Instalación

Sigue estos pasos para configurar y ejecutar el proyecto en tu entorno local:

1. Clona el repositorio de GitHub en tu máquina local:

   ```bash
   git clone Palaciodiego008/netgrid-api
   ```

2. Navega al directorio del proyecto:

   ```bash
   cd proyecto-gestion-laravel
   ```

3. Copia el archivo `.env.example` a `.env` y configura las variables de entorno, incluyendo la configuración de la base de datos:

   ```bash
   cp .env.example .env
   ```

4. Instala las dependencias del proyecto con Composer:

   ```bash
   composer install
   ```

5. Ejecuta las migraciones para crear las tablas de la base de datos:

   ```bash
   php artisan migrate
   ```

6. Inicia el servidor de desarrollo de Laravel:

   ```bash
   php artisan serve
   ```

7. Abre tu navegador y accede a `http://localhost:8000` para ver la aplicación en funcionamiento.

## Uso

La aplicación proporciona una serie de endpoints para gestionar proyectos y tareas. A continuación, se enumeran algunos de los principales:

- `POST /register:` Registra un nuevo usuario.
- `POST /login:` Inicia sesión como usuario registrado.
- `POST /logout:` Cierra la sesión del usuario.
- `GET /user-profile:` Muestra el perfil del usuario autenticado.
- `GET /projects:` Obtiene una lista de proyectos con opciones de filtro.
- `POST /projects:` Crea un nuevo proyecto.
- `GET /projects/{id}:` Muestra los detalles de un proyecto específico.
- `PUT /projects/{id}:` Actualiza un proyecto existente.
- `DELETE /projects/{id}:` Elimina un proyecto.
- `GET /projects/{project}/tasks:` Obtiene una lista de tareas en un proyecto con opciones de filtro.
- `POST /projects/{project}/tasks:` Crea una nueva tarea en un proyecto.
- `GET /projects/{project}/tasks/{id}:` Muestra los detalles de una tarea específica.
- `PUT /projects/{project}/tasks/{id}:` Actualiza una tarea existente.
- `DELETE /projects/{project}/tasks/{id}:` Elimina una tarea.

Asegúrate de autenticarte antes de acceder a los endpoints que requieren autenticación.


¡Disfruta de la gestión de proyectos simplificada con esta aplicación desarrollada en Laravel!
