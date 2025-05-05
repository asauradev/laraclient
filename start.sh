#!/usr/bin/env bash
set -o errexit

# Instala dependencias PHP
composer install --no-dev --optimize-autoloader

# Link storage
php artisan storage:link || true

# Ejecuta migraciones
php artisan migrate --force

# Inicia el servidor
php artisan serve --host=0.0.0.0 --port=10000
