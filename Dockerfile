# PHP-FPM untuk menjalankan CI4
FROM php:8.2-fpm-alpine

# Install dependencies sistem + ekstensi PHP yang umum dipakai CI4
RUN apk add --no-cache \
    git curl unzip icu-dev oniguruma-dev \
    && docker-php-ext-install intl mbstring mysqli pdo pdo_mysql

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy composer files dulu untuk cache layer
COPY composer.json composer.lock* ./
RUN composer install --no-dev --prefer-dist --no-interaction --no-progress || true

# Copy seluruh project
COPY . .

# Pastikan writable bisa ditulis
RUN chown -R www-data:www-data writable \
    && chmod -R 775 writable

# CI4 biasanya publish dari folder public
EXPOSE 9000
CMD ["php-fpm"]