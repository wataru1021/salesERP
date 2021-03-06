# docker-laravel ð³

![License](https://img.shields.io/github/license/ucan-lab/docker-laravel?color=f05340)
![Stars](https://img.shields.io/github/stars/ucan-lab/docker-laravel?color=f05340)
![Issues](https://img.shields.io/github/issues/ucan-lab/docker-laravel?color=f05340)
![Forks](https://img.shields.io/github/forks/ucan-lab/docker-laravel?color=f05340)

## Introduction

Build a simple laravel development environment with docker-compose.

## Usage

```bash
$ git clone git@github.com:ucan-lab/docker-laravel.git
$ cd docker-laravel
$ make create-project # Install the latest Laravel project
$ make install-recommend-packages # Optional
```

http://localhost

## Tips

- Read this [Makefile](https://github.com/ucan-lab/docker-laravel/blob/main/Makefile).
- Read this [Wiki](https://github.com/ucan-lab/docker-laravel/wiki).

## Container structures

```bash
âââ app
âââ web
âââ db
```

### app container

- Base image
  - [php](https://hub.docker.com/_/php):8.0-fpm-buster
  - [composer](https://hub.docker.com/_/composer):2.0

### web container

- Base image
  - [nginx](https://hub.docker.com/_/nginx):1.20-alpine
  - [node](https://hub.docker.com/_/node):16-alpine

### db container

- Base image
  - [mysql/mysql-server](https://hub.docker.com/r/mysql/mysql-server):8.0




1. å®è¡ç°å¢ã®æ´å
â» docker-compose.yml ã®ãããã©ã«ãã§å®è¡ãã¾ã
docker-compose up
make app
2. Laravelè¨­å®
composer install
composer dump-autoload
cp .env.sample .env
-> .envã®ä¸­èº«ããå¥½ã¿ã§å¤æ´
php artisan key:generate
php artisan migrate:fresh --seed
exit
3. è¡¨ç¤ºã®è¨­å®
â» backend/ã§å®è¡ãã¾ã
nmp install
npm run dev 

docker-compose down --rmi all --volumes --remove-orphans
