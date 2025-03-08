# Proyecto Backend de Posts con Laravel

## Descripción
Este es un proyecto backend desarrollado con **Laravel**, el framework de PHP más popular y robusto.
Incluye controladores, modelos, migraciones y configuración de base de datos.

---

## Requisitos

Antes de comenzar, asegúrate de tener instalados los siguientes requisitos:

- **PHP** >= 8.1
- **Composer** (https://getcomposer.org/)
- **Laravel** (se instalará con Composer)
- **PostgreSQL** o cualquier otra base de datos compatible
- **Node.js y npm** (opcional, si se usa Laravel Mix para assets)

---

## Instalación

1. Clonar el repositorio:

   ```sh
   git clone https://github.com/Evy32/PostsPTBack.git
   cd tuproyecto
   ```

2. Instalar dependencias de PHP con Composer:

   ```sh
   composer install
   ```

3. Copiar el archivo de configuración:

   ```sh
   cp .env.example .env
   ```

4. Configurar la base de datos en el archivo `.env`:

   ```env
   DB_CONNECTION=pgsql
   DB_HOST=127.0.0.1
   DB_PORT=5432
   DB_DATABASE=PostsPT
   DB_USERNAME=tu_usuario
   DB_PASSWORD=tu_contraseña
   ```

5. Ejecutar migraciones para crear las tablas:

   ```sh
   php artisan migrate
   ```

---

## Ejecución del Servidor

Para iniciar el servidor de desarrollo de Laravel, ejecuta:

```sh
php artisan serve
```

El backend estará disponible en: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## Comandos útiles

- **Ver todas las rutas registradas:**
  ```sh
  php artisan route:list
  ```
- **Verificar el estado de las migraciones:**
  ```sh
  php artisan migrate:status
  ```
- **Revertir todas las migraciones y volver a correrlas:**
  ```sh
  php artisan migrate:fresh --seed
  ```



