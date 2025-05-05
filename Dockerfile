FROM php:8.3-fpm

# Instala dependencias necesarias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip unzip git curl \
    libpng-dev libjpeg-dev libfreetype6-dev \
    libonig-dev libxml2-dev \
    && docker-php-ext-configure gd \
    --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_pgsql zip gd mbstring

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define directorio de trabajo
WORKDIR /var/www

# Copia el proyecto
COPY . .

# Instala dependencias Laravel
RUN composer install --no-dev --optimize-autoloader

# Genera clave de app y enlaces
RUN php artisan key:generate && php artisan storage:link || true

# Expone el puerto
EXPOSE 8000

# Comando de arranque
CMD php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8000
