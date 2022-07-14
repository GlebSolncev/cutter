<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Cutter

Cut links with limit and save in db. Work with docker.
Added Makefile for with usability `make`

#### Guide
- Update .env  from .env.example `cp .env.example .env`
- Set DB info:
    - DB_CONNECTION=mysql
    - DB_HOST=db
    - DB_PORT=3306
    - DB_DATABASE=cutter
    - DB_USERNAME=user
    - DB_PASSWORD=mypassword
- Build project: `make build`
- Up containers: `make up`
- You need enter `composer install` and `key:generate` in container php-fpm
  - `make cli`
  - `composer install`
  - `php artisan key:generate`
- [Go to link](http://localhost:8000)

#### Help instruction
- You can saw list commands: `make help`
- Sometimes you need check containers if localhost doesen't work `docker-compose ps`
- When you in three step, you need wait some 265.1s(it's my time)
- If you have a few questions - send me to telegram @glurk