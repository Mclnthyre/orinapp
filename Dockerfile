# Dockerfile simples para Laravel no Render (usa php built-in server)
FROM php:8.2-cli

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git curl wget \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instala composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copia apenas composer files primeiro para cache
COPY composer.json composer.lock ./

# Instala dependências PHP (sem dev)
RUN composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

# Copia o restante do projeto
COPY . .

# Permissões de storage e cache
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Expõe uma porta qualquer (Render definirá $PORT)
EXPOSE 10000

# Start: usa a variável $PORT do ambiente Render
CMD ["sh", "-c", "php -S 0.0.0.0:${PORT:-10000} -t public"]
