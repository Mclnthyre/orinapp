# Stage 1: build (instala composer)
FROM php:8.2-fpm

# dependências do sistema
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copia composer files e instala dependências
COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Copia restante do projeto
COPY . .

# Permissões
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Gera key (opcional, se não usar env var)
# RUN php artisan key:generate

# Exponha porta (Render usa porta $PORT)
EXPOSE 10000

# Start command: php-fpm and nginx via supervisor script is ideal,
# but Render will run the container and atender ao PORT via internal web server.
CMD ["php", "-S", "0.0.0.0:10000", "-t", "public"]
