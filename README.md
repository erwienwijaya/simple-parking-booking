<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Simple Parking Booking

Docker development implementation for Laravel 8.\* with:

- Nginx
- PostgreSQL
- PHP8.0

## Installation

- Clone this repository `git clone git@github.com:erwienwijaya/simple-parking-booking.git`
- Copy `.env` file: `cp .env.example .env`
- Set the environment variables in `.env` file
- Run command: `docker-compose up --build -d`
- Run the container in bash mode: `docker exec -it Simple-Parking_php /bin/sh`
- Inside this container now you can run all the commands as if if you are on local environment:
- Install composer dependencies: `composer install`
- Generate key: `php artisan key:generate`
- Run migration and seeder: `php artisan migrate:fresh --seed`
- Access the project at: `http://localhost:8000`

## Testing
- Config testing : `.env.testing`
- Database testing using `PostgreSQL` with database name = `testing`
- Before running test, make sure go inside first at: `docker exec -it Simple-Parking_php /bin/sh`
- Run command: `php artisan test` or `php artisan test --env=testing`

## Documentation
- Access the API documentation at: `http://localhost:8000/api/documentation`
- How to authorize: Bearer `<token>`
