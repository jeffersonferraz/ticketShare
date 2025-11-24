FROM php:8.3-apache

# Install required system packages and PHP extensions
RUN apt-get update \
    && apt-get install -y \
        sendmail \
        libpng-dev \
        libzip-dev \
        zlib1g-dev \
        libonig-dev \
        unzip \
        git \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install zip pdo pdo_mysql

# Install Composer globally
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer