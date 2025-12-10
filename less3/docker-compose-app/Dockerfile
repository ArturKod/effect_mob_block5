FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install \
        pdo\
        pdo_mysql \
        mysqli\
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY src/ .

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

HEALTHCHECK --interval=30s --timeout=3s --start-period=5s --retries=3 \
    CMD php -r "exit(0);" || exit 1