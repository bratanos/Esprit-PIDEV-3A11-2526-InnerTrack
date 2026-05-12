FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libicu-dev libpng-dev libzip-dev libonig-dev libxml2-dev libcurl4-openssl-dev \
    zip unzip git \
    && docker-php-ext-install intl gd opcache pdo_mysql zip mbstring bcmath

# Set DocumentRoot to /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Enable Apache Rewrite Module
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application files
WORKDIR /var/www/html
COPY . .

# Install dependencies
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV COMPOSER_MEMORY_LIMIT=-1
RUN composer install --no-dev --optimize-autoloader --no-scripts --ignore-platform-reqs

# Create dummy .env and set permissions
RUN echo "APP_ENV=prod" > .env
RUN mkdir -p var/cache var/log && chown -R www-data:www-data var/

# Verify that the public folder exists (this will show up in your Render logs)
RUN ls -la /var/www/html/public

EXPOSE 80
CMD ["apache2-foreground"]
