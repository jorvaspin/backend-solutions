
#  📌 D-Solutions - Backend Slim Framework

Este proyecto implementa una **API Backend en slim framework** donde se trabaja con JWT para aumentar la seguridad y crear los endpoints correspondientes de listar y crear usuarios.

---


##  Explicación del proyecto

  

###  **Objetivo**

Se crean 3 endpoints para realizar la prueba técnica las cuales son las siguientes, con sus respectivos ejemplos:


### 1.- Obtener token de autentificación 
--- Petición para obtener token
## POST - `/login`

#### Body

```json POST -
{
    "username": "admin",
    "password": "123456"
}
```

#### Response

```json
{
    "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE3NDE2NzQ5NzgsImV4cCI6MTc0MTc2MTM3OCwic3ViIjoiYWRtaW4ifQ.CheDD3MdJMCB3GqOkZk6iVPphXuviz8HOF8oZuGqZ9I"
}
```


--- Petición para traer a todos los usuarios registrados
## GET - `/api/listUsers` -- Requiere token Bearer

#### Response

```json
{
    "name": "Ignacio Vasquez",
    "avatar": "https://cloudflare-ipfs.com/ipfs/Qmd3W5DuhgHirLHGVixi6V76LhCkZUz6pnFt5AJBiyvHye/avatar/870.jpg",
    "gender": "male",
    "email": "ignacio@example.org",
    "ubication": "Chile",
    "age": 33,
    "id": "1"
}
```


--- Petición para crear un usuario con la siguiente estructura
## POST - `/api/createUser` -- Requiere token Bearer

#### Body

```json POST -
{
"name": "Esteban Lopez",
"avatar": "https://cloudflare-ipfs.com/ipfs/Qmd3W5DuhgHirLHGVixi6V76LhCkZUz6pnFt5AJBiyvHye/avatar/870.jpg",
"gender": "male",
"email": "esteban@example.org",
"ubication": "La cisterna, Chile",
"age": 22
}
```

#### Response

```json
{
    "msg": "Usuario creado exitosamente",
    "status": "created",
    "code": 200
}
```

Estos endpoint traen información real desde una api externa el cual usamos como pivote para traer y almacenar información real. La página usada fue: https://mockapi.io.
  

#  📁 Ejecución del proyecto

  

##  Guía de Instalación y Ejecución del Proyecto

  

Esta guía te ayudará a configurar y ejecutar el proyecto tanto en tu entorno local.  

###  1. Clonar el Repositorio

```bash

git clone [URL_DEL_REPOSITORIO]

cd [NOMBRE_DEL_PROYECTO]

```

  
###  2. Instalar Dependencias con composer

  
```bash

composer install
composer start

```

###  3. Iniciar el Servidor

  

Para iniciar el proyecto y dejar la API URL operativa lanzar el siguiente comando

  

```bash

php -S localhost:8000 -t public

```

  

El servidor debería estar funcionando en `http://localhost:8000`. por ende las URL de la API serian:  

```bash

http://localhost:8000/api/listUsers
http://localhost:8000/api/createUser
http://localhost:8000/login

```

Estas url son las que deben reemplazar en el fronted de la aplicación donde consumiremos los datos.