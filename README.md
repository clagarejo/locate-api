
# Prueba Técnica - Backend
- Este repositorio contiene el código del backend para la prueba técnica de Locatel.

## Requisitos del Sistema
    1. PHP >= 7.3
    2. Composer
    3. Servidor web (Laragon, XAMPP, etc.)
    
### Configuración de la Base de Datos
    1. Crea una nueva base de datos en tu gestor de base de datos preferido.
    2. Copia el archivo .env.example y renómbralo a .env.
    1. Configura las credenciales de conexión a la base de datos en el archivo .env.

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nombre_base_de_datos
    DB_USERNAME=usuario
    DB_PASSWORD=contraseña

### Instalación
    1.Descarga o clona este repositorio en tu máquina local.
    2. Navega hasta la carpeta del proyecto.
    3. Ejecuta composer install para instalar las dependencias del proyecto.

### Ejecución del Servidor
    1. Ejecuta el comando php artisan serve para iniciar el servidor de desarrollo.
    2. El servidor estará disponible en http://localhost:8000.

### Frontend
Para ejecutar las funcionalidades de forma satisfactoria, es necesario ejecutar también el frontend. Puedes encontrar las instrucciones para ejecutar el frontend en el siguiente enlace: https://github.com/clagarejo/test-front


