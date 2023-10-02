# Proyecto de Gestión de Proyectos en Laravel

Este es un proyecto de gestión de proyectos desarrollado en Laravel, que incluye funciones para registrar usuarios, iniciar sesión, crear, ver, actualizar y eliminar proyectos, así como crear, ver, actualizar y eliminar tareas dentro de los proyectos.

## Requisitos del Sistema

Asegúrate de tener los siguientes requisitos en tu sistema antes de ejecutar la aplicación:

- PHP 7.4 o superior
- Composer
- MySQL
- Node.js (para compilar activos CSS/JS)
- Un servidor web (por ejemplo, Apache o Nginx)

Copia el archivo .env.example a .env y configura tus variables de entorno, incluyendo la configuración de la base de datos:

cp .env.example .env

composer install

php artisan migrate

php artisan serve


Abre tu navegador y accede a http://localhost:8000 para ver la aplicación.

Uso
La aplicación proporciona los siguientes endpoints para gestionar proyectos y tareas:

`POST /register:` Registrar un nuevo usuario.
`POST /login:` Iniciar sesión como usuario registrado.
`POST /logout:` Cerrar sesión.
`GET /user-profile:` Ver el perfil del usuario autenticado.
`GET /projects:` Obtener una lista de proyectos (con opciones de filtro).
`POST /projects:` Crear un nuevo proyecto.
`GET /projects/{id}:` Ver los detalles de un proyecto específico.
`PUT /projects/{id}:` Actualizar un proyecto existente.
`DELETE /projects/{id}:` Eliminar un proyecto.
`GET /projects/{project}/tasks:` Obtener una lista de tareas en un proyecto (con opciones de filtro).
`POST /projects/{project}/tasks:` Crear una nueva tarea en un proyecto.
`GET /projects/{project}/tasks/{id}:` Ver los detalles de una tarea específica.
`PUT /projects/{project}/tasks/{id}:` Actualizar una tarea existente.
`DELETE /projects/{project}/tasks/{id}:` Eliminar una tarea.
Asegúrate de autenticarte antes de acceder a los endpoints que requieren autenticación.
