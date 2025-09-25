# Base PHP avec FPM
FROM php:8.4-fpm

# Installe les dépendances système
RUN apt-get update && apt-get install -y \
    git unzip curl libicu-dev libonig-dev libxml2-dev zip \
    libzip-dev libpng-dev libjpeg-dev libfreetype6-dev \
    libpq-dev libxslt1-dev libcurl4-openssl-dev \
    && docker-php-ext-install intl pdo pdo_mysql mbstring xml zip gd xsl

# Installe Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Créer le dossier de travail
WORKDIR /var/www/html

# 🔁 Copie les fichiers du projet
COPY . .

# Installe les dépendances Symfony
RUN composer install --no-dev --optimize-autoloader

# Donne les bons droits
RUN chown -R www-data:www-data /var/www/html

# Active les permissions pour cache/logs
RUN chmod -R 775 var

# Lance PHP-FPM
CMD ["php-fpm"]

# Expose le port FPM
EXPOSE 9000