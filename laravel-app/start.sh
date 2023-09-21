#!/bin/bash

# Start Laravel Echo Server
laravel-echo-server start &

# Start Laravel application (assuming you're using artisan serve)
php artisan serve --host=0.0.0.0 --port=8000

# Start PHP-FPM
php-fpm
