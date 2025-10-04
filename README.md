# 🧩 API REST - TumiSoft (Laravel 9)

Proyecto de evaluación técnica desarrollado con **Laravel 9**, siguiendo buenas prácticas de arquitectura (Controllers, Services, Form Requests, manejo de excepciones, Jobs, Logging y Middleware de autenticación con Sanctum).

---

## 🚀 Requisitos previos

Asegúrate de tener instalado en tu equipo:

- [PHP >= 8.0](https://www.php.net/downloads)
- [Composer](https://getcomposer.org/)
- [MySQL o MariaDB](https://www.apachefriends.org/index.html) (puedes usar XAMPP, Laragon o Docker)
- [Node.js y NPM](https://nodejs.org/)
- [Git](https://git-scm.com/)
- [Postman o Insomnia](https://www.postman.com/) para probar los endpoints

---

## ⚙️ Instalación del proyecto

### 1️⃣ Clonar el repositorio
```bash
git clone https://github.com/<TU_USUARIO>/<NOMBRE_DEL_REPO>.git
cd <NOMBRE_DEL_REPO>
2️⃣ Instalar dependencias PHP
bash
Copiar código
composer install
3️⃣ Crear archivo de entorno
bash
Copiar código
cp .env.example .env
4️⃣ Generar la clave de la aplicación
bash
Copiar código
php artisan key:generate
5️⃣ Configurar la base de datos
Edita el archivo .env con tus credenciales locales:

env
Copiar código
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tumisoft_api
DB_USERNAME=root
DB_PASSWORD=
6️⃣ Ejecutar migraciones y seeders
bash
Copiar código
php artisan migrate --seed
Esto creará las tablas necesarias y llenará la base con datos de ejemplo.

7️⃣ Iniciar el servidor local
bash
Copiar código
php artisan serve
Tu API estará disponible en:
👉 http://127.0.0.1:8000