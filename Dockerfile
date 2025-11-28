# Dockerfile simples para Laravel no Render (usa php built-in server)
FROM php:8.2-cli

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    libpng-dev libonig-dev libxml2-dev zip unzip curl wget \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instala composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

# Copia arquivos do Composer antes (cache)
COPY composer.json composer.lock ./

# Instala dependências sem dev
RUN composer install --no-dev --optimize-autoloader --prefer-dist --no-interaction

# Copia restante do projeto
COPY . .

# Permissões
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 10000

# Start
CMD ["sh", "-c", "php -S 0.0.0.0:${PORT:-10000} -t public"]
