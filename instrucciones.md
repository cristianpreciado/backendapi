# Backend - API

instalacion de dependencias.
```sh
composer install
```
# comandos laravel
generador de tabla users
```sh
php artisan migrate
```
poblar tabla users(11 usuarios) contraseña por defecto **secure**
```sh
php artisan db:seed --class=UsersTableSeeder
```
crear el enlace simbólico para imagenes que se almacenaran en el proyecot por acada usuario
```sh
php artisan storage:link
```
correr servidor de laravel para realizar las pruebas y sus diferentes consumos de API 
```sh
php artisan serve
```