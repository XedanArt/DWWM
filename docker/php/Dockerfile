# Base PHP avec FPM
FROM php:8.4-fpm

# Installe les dépendances système
RUN apt-get update && apt-get install -y \
    git unzip curl libicu-dev libonig-dev libxml2-dev zip \
    libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libpq-dev libxslt1-dev libcurl4-openssl-dev gnupg ca-certificates \
    && docker-php-ext-install intl pdo pdo_mysql mbstring xml zip gd xsl opcache

# Installe Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installe Symfony CLI via binaire Linux compatible
RUN curl -sS -L https://github.com/symfony-cli/symfony-cli/releases/latest/download/symfony_linux_amd64 \
    -o /usr/local/bin/symfony \
    && chmod +x /usr/local/bin/symfony

WORKDIR /var/www/html
RUN chown -R www-data:www-data /var/www/html
EXPOSE 9000
CMD ["php-fpm"]