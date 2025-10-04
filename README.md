# 🧩 API REST - TumiSoftAPI (Laravel 9)

Proyecto de evaluación técnica desarrollado con **Laravel 9**, siguiendo buenas prácticas de desarrollo:  
- Arquitectura limpia (Controllers, Services, Requests).  
- Manejo centralizado de excepciones (`Handler`).  
- Validaciones con **Form Requests**.  
- **Jobs y Logs** para procesos asincrónicos.  
- Autenticación con **Laravel Sanctum**.

---

## 🚀 Pasos para instalar y ejecutar el proyecto localmente

### 1️⃣ Clonar el repositorio
```bash
git clone https://github.com/terryvargas98/TumiSoftAPI
cd TumiSoftAPI
```
   
### 2️⃣ Instalar dependencias PHP
```bash
composer install
```

### 3️⃣ Crear el archivo de entorno
```bash
cp .env.example .env
```

### 4️⃣ Generar la clave de la aplicación
```bash
php artisan key:generate
```

### 5️⃣ Configurar la base de datos  
Edita el archivo `.env` y coloca tus credenciales locales:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sales
DB_USERNAME=root
DB_PASSWORD=
```

### 6️⃣ Ejecutar migraciones y seeders  
```bash
php artisan migrate --seed
```

Esto creará las tablas y agregará datos de ejemplo (usuarios, productos y pedidos).

### 7️⃣ Iniciar el servidor  
```bash
php artisan serve
```

Tu API estará disponible en:
```
http://127.0.0.1:8000
```

---

## ⚙️ Instrucciones para configurar la base de datos

1. Asegúrate de tener **MySQL o MariaDB** corriendo (puedes usar XAMPP o Laragon).  
2. Crea una base de datos vacía:
   ```sql
   CREATE DATABASE sales;
   ```
3. Verifica que tus credenciales en `.env` coincidan con tu entorno local.  
4. Ejecuta migraciones y seeders:
   ```bash
   php artisan migrate --seed
   ```

---

## 🧩 Ejemplo de archivo `.env.example`

```env
APP_NAME=TumiSoftAPI
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sales
DB_USERNAME=root
DB_PASSWORD=

QUEUE_CONNECTION=database
SESSION_DRIVER=file
SESSION_LIFETIME=120

SANCTUM_STATEFUL_DOMAINS=localhost,127.0.0.1
SESSION_DOMAIN=localhost
```

---

## 👨‍💻 Autor

**Terry Vargas**  
📧 [terryvargas98@hotmail.com]  
🌐 [https://github.com/terryvargas98]

---

## 📄 Licencia

Este proyecto se distribuye bajo la licencia **MIT**.
