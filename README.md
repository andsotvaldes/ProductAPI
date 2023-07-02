
# Product API

Se ha realizado la implementacion del proyecto Producto API, con ella se quiere gestionar los productos de la aplicacion para poder listarlos y crearlos.

Para este proyecto se ha realizado con el docker ya preparado de [Symfony Docker](https://github.com/dunglas/symfony-docker)

Se ha usado los bundles:
* [NelmioApiDocBundle](https://symfony.com/bundles/NelmioApiDocBundle/current/index.html) -> Para poder generar la documentacion de la API
* [LexikJWTAuthenticationBundle](https://symfony.com/bundles/LexikJWTAuthenticationBundle/current/index.html) -> Para gestionar el token JWT, autentificacion y seguridad del sistema

Se ha usado una arquitectura hexagonal , donde se ha definido una estructura de ficheros propia de esta arquitectura.

En el modelo del sistema se ha definido:
* Producto
* Usuario - Usuario para poder acceder a la aplicacion.

Se ha definido un Usuario por defecto como:
```
username: "admin@admin.com"
password: "admin@admin.com"
```
Se ha definido los repositorios del modelo y los repositorios de persistencia de cada modelo.

Se ha definido cada caso de uso de la aplicacion, seria los casos de uso de listado y creado de Producto

Para poder gestionar mejor el creado de producto , tambien se ha definido un Formulario
Para poder gestionar mejor el listado de producto, se ha creado un Filtro

Por seguridad , he añadido un Evento para cada vez que recibe una llamada en el controlador compruebe si en la cabecera contiene 'Content-type: application/json'

He definido los controladores con las rutas:
* v1/products GET -> Donde se pueden listar los productos del sistema , se puede añadir filtros
* v1/product POST -> Donde se pueden crear producto
* v1/login POST -> Llamada interna del bundle de LexikJWTAuthenticationBundle

Para poder acceder a la documentacion de la API se ha usado Swagger para poder generarlo automaticamente.
```
https://localhost/api/doc
```
En el testing , se ha creado clases Fixture para poder hacer el volcado de datos. Se han realizado los test de cada llamada.

# Requisitos previos
* Docker
* docker-compose

# Instalacion
Para poder instalar el proyectos solo hay que entrar en la raiz del proyectos y ejecutar la siguiente sentencia:
```
docker-compose up -d
```
Y ya podrias acceder a traves de:
```
https://localhost
```

# Testing
Para ejecutar los testing se ha preparado para ejecutar en una nueva base de datos, para poder hacer esto hay que ejecutar estos 3 comandos para iniciarla y volcar los datos de prueba.

```
php bin/console --env=test doctrine:database:create
php bin/console --env=test doctrine:schema:create
php bin/console --env=test doctrine:fixtures:load
```
Con estos comandos ejecutados podemos ver los test

```
php bin/phpunit
```
