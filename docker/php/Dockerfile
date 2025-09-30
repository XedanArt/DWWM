FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    git unzip libicu-dev libpq-dev libzip-dev zip curl \
    && docker-php-ext-install intl pdo pdo_mysql zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN echo "variables_order = \"EGPCS\"" >> /usr/local/etc/php/conf.d/docker-vars.ini

WORKDIR /var/www/html