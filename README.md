# API REST - Proyecto RDS

API REST desarrollada en Laravel para la gestión de empleados, cargos y funciones cargo, con autenticación mediante Laravel Sanctum.

---

## Descripción

Este proyecto permite realizar operaciones CRUD sobre:

* Empleados
* Cargos
* Funciones cargo

Además, protege las rutas mediante autenticación con token Bearer usando Sanctum.

---

## Requisitos

Antes de ejecutar el proyecto asegúrate de tener instalado:

* PHP
* Composer
* MySQL
* Node.js y NPM
* Git Bash
* Laravel compatible con la versión del proyecto

---

## Instalación del proyecto

### 1. Clonar el repositorio

```bash
git clone URL_DEL_REPOSITORIO
cd NOMBRE_DEL_PROYECTO
```

### 2. Instalar dependencias de PHP

```bash
composer install
```

### 3. Crear el archivo de entorno

```bash
cp .env.example .env
```

### 4. Configurar la base de datos

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_base_de_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

### 5. Generar la llave de la aplicación

```bash
php artisan key:generate
```

### 6. Ejecutar migraciones

```bash
php artisan migrate
```

### 7. Ejecutar seeders

```bash
php artisan db:seed
```

o

```bash
php artisan migrate:fresh --seed
```

### 8. Levantar el servidor

```bash
php artisan serve
```

La aplicación quedará disponible en:

```text
http://127.0.0.1:8000
```

---

# Autenticación

## Registrar usuario

```bash
curl -X POST http://127.0.0.1:8000/api/register -H "Content-Type: application/json" -H "Accept: application/json" -d '{"name":"santos","email":"ruix@gmail.com","password":"123456790"}'
```

## Cerrar seccion 
```bash
curl -X POST http://127.0.0.1:8000/api/logout -H "Authorization: Bearer 5|241zz3hi9p1mJiI4kXCGprLb2xDGLdGlpkIPkn3tb282cc85" -H "Accept: application/json" 
```

Respuesta esperada:

* Usuario creado correctamente.
* Token de acceso.

## Iniciar sesión

```bash
curl -X POST http://127.0.0.1:8000/api/login -H "Content-Type: application/json" -H "Accept: application/json" -d '{"email":"ruix@gmail.com","password":"123456790"}'
```

Respuesta esperada:

* Mensaje de autenticación exitosa.
* Datos del usuario.
* Token de acceso.

## Ejemplo de uso del token

```bash
curl http://127.0.0.1:8000/api/cargos -H "Authorization: Bearer TU_TOKEN_AQUI" -H "Accept: application/json"
```

---

# 1. Empleados

## Listar empleados

```bash
curl http://127.0.0.1:8000/api/empleados -H "Authorization: Bearer TU_TOKEN_AQUI" -H "Accept: application/json"
```

## Obtener empleado por ID

```bash
curl http://127.0.0.1:8000/api/empleados/1 -H "Authorization: Bearer TU_TOKEN_AQUI" -H "Accept: application/json"
```

## Crear empleado

```bash
curl -X POST http://127.0.0.1:8000/api/empleados -H "Authorization: Bearer TU_TOKEN_AQUI" -H "Content-Type: application/json" -H "Accept: application/json" -d '{"nombre":"Juan","apellido":"Perez","fecha_nacimiento":"1998-05-10","fecha_de_ingreso":"2024-01-15","salario":25000,"estado":"activo","id_cargo":1}'
```

## Actualizar empleado

```bash
curl -X PUT http://127.0.0.1:8000/api/empleados/1 -H "Authorization: Bearer TU_TOKEN_AQUI" -H "Content-Type: application/json" -H "Accept: application/json" -d '{"nombre":"Juan Carlos","apellido":"Perez Gomez","fecha_nacimiento":"1998-05-10","fecha_de_ingreso":"2024-01-15","salario":3000000,"estado":"activo","id_cargo":1}'
```

## Eliminar empleado

```bash
curl -X DELETE http://127.0.0.1:8000/api/empleados/1 -H "Authorization: Bearer TU_TOKEN_AQUI" -H "Accept: application/json"
```

---

# 2. Cargos

## Listar cargos

```bash
curl http://127.0.0.1:8000/api/cargos -H "Authorization: Bearer TU_TOKEN_AQUI" -H "Accept: application/json"
```

## Obtener cargo por ID

```bash
curl http://127.0.0.1:8000/api/cargos/1 -H "Authorization: Bearer TU_TOKEN_AQUI" -H "Accept: application/json"
```

## Crear cargo

```bash
curl -X POST http://127.0.0.1:8000/api/cargos -H "Authorization: Bearer TU_TOKEN_AQUI" -H "Content-Type: application/json" -H "Accept: application/json" -d '{"nombre_cargo":"Desarrollador Backend","descripcion":"Encargado de desarrollar y mantener la API"}'
```

## Actualizar cargo

```bash
curl -X PUT http://127.0.0.1:8000/api/cargos/1 -H "Authorization: Bearer TU_TOKEN_AQUI" -H "Content-Type: application/json" -H "Accept: application/json" -d '{"nombre_cargo":"Arquitecto de Software","descripcion":"Disena la estructura tecnica del sistema"}'
```

## Eliminar cargo

```bash
curl -X DELETE http://127.0.0.1:8000/api/cargos/1 -H "Authorization: Bearer TU_TOKEN_AQUI" -H "Accept: application/json"
```

---

# 3. Funciones Cargo

## Listar funciones cargo

```bash
curl http://127.0.0.1:8000/api/funcionCargos -H "Authorization: Bearer TU_TOKEN_AQUI" -H "Accept: application/json"
```

## Obtener función cargo por ID

```bash
curl http://127.0.0.1:8000/api/funcionCargos/1 -H "Authorization: Bearer TU_TOKEN_AQUI" -H "Accept: application/json"
```

## Crear función cargo

```bash
curl -X POST http://127.0.0.1:8000/api/funcionCargos -H "Authorization: Bearer TU_TOKEN_AQUI" -H "Content-Type: application/json" -H "Accept: application/json" -d '{"descripcion_funcion":"Gestionar la base de datos","estado":"activo","id_cargo":1}'
```

## Actualizar función cargo

```bash
curl -X PUT http://127.0.0.1:8000/api/funcionCargos/1 -H "Authorization: Bearer TU_TOKEN_AQUI" -H "Content-Type: application/json" -H "Accept: application/json" -d '{"descripcion_funcion":"Administrar servidores","estado":"inactivo","id_cargo":1}'
```

## Eliminar función cargo

```bash
curl -X DELETE http://127.0.0.1:8000/api/funcionCargos/1 -H "Authorization: Bearer TU_TOKEN_AQUI" -H "Accept: application/json"
```

---

# Ejecución de pruebas

## Ejecutar todas las pruebas

```bash
php artisan test
```

## Ejecutar pruebas de cargos

```bash
php artisan test --filter=CargoTest
```

## Ejecutar pruebas de funciones cargo

```bash
php artisan test --filter=FuncionCargoTest
```

## Ejecutar pruebas de empleados

```bash
php artisan test --filter=EmpleadoTest
```

---

# Autor

Jose de Los Santos Ruiz Perez
