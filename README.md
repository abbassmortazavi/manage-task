<p align="center"><a href="https://laravel.com" target="_blank"></a> <b>Task Management</b>
<p align="center">

</p>



## Services
- Nginx
- Mysql
- PHP (8.3)
- PhpMyAdmin
- Composer
- Swagger(for api documentation)

## Installation
```sh
docker-compose up -d --build
docker-compose up -d down
```

## Composer update or Install
```sh
docker-compose run --rm composer i
docker-compose run --rm composer u
```

## Config Env file in laravel after build docker
```sh
step 1 : run this command: cp .env.example .env
step 2: in this .env.example i set my token and you can test it! 
```

## Project Host for test Api
```sh
like this : http://localhost:8082
this is my localhost in my system.
sample : http://localhost:8082/api/task/lists
```

## Project Documentation Swagger
```sh
like this : http://localhost:8082/api/documentation#/
```
