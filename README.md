# API de Gestión de Préstamos

API REST desarrollada con Laravel 12 para la gestión de préstamos de equipos.

## Requisitos

- PHP >= 8.2
- Composer
- MySQL >= 5.7


## Instalación

1. **Clonar el repositorio**
```bash
git clone https://github.com/leyson2/gestion-prestamo.git
cd gestion-prestamo
```

2. **Instalar dependencias de PHP**
```bash
composer install
```

3. **Configurar variables de entorno**
```bash
cp .env.example .env
```

Editar el archivo `.env` y configurar la base de datos:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestion_prestamo
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

4. **Generar la clave de la aplicación**
```bash
php artisan key:generate
```

5. **Crear la base de datos**
Crear la base de datos manualmente en MySQL:
```sql
CREATE DATABASE gestion_prestamo;
```

6. **Ejecutar las migraciones**
```bash
php artisan migrate
```

7. **Ejecutar los seeders (opcional, para datos de prueba)**
```bash
php artisan db:seed
```

8. **Iniciar el servidor**
```bash
php artisan serve
```

La API estará disponible en `http://localhost:8000`

## Endpoints de la API

### Préstamos

- `GET /api/prestamos` - Listar todos los préstamos
- `POST /api/prestamos` - Crear un nuevo préstamo
- `GET /api/prestamos/{id}` - Obtener un préstamo específico
- `PUT /api/prestamos/{id}` - Actualizar un préstamo
- `DELETE /api/prestamos/{id}` - Eliminar un préstamo
- `PATCH /api/prestamos/cambiar-estado/{id}` - Cambiar el estado de un préstamo

### Equipos

- `GET /api/equipos` - Listar todos los equipos
- `POST /api/equipos` - Crear un nuevo equipo

## Estructura del Proyecto

```
app/
├── Http/
│   ├── Controllers/     # Controladores de la API
│   └── Requests/        # Form Requests para validación
├── Models/              # Modelos Eloquent
├── Repositories/        # Capa de repositorio
├── Services/            # Lógica de negocio
└── Interfaces/          # Contratos/Interfaces
```

## Tecnologías Utilizadas

- Laravel 12
- MySQL
- PHP 8.2+
- Repository Pattern
- Service Layer Pattern

## Licencia

Este proyecto es de código abierto bajo la licencia MIT.
