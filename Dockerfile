# --- Etapa 1: Build ---
FROM php:8.2-cli as build

WORKDIR /app

COPY composer.json ./
COPY composer.lock ./
RUN curl -sS https://getcomposer.org/installer | php
RUN php composer.phar install --no-dev --optimize-autoloader --prefer-dist --no-interaction

COPY . .

# --- Etapa 2: Runtime ---
FROM php:8.2-apache

WORKDIR /var/www/html

COPY --from=build /app ./

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
