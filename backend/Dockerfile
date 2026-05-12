FROM php:8.2-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libicu-dev libpng-dev libzip-dev libonig-dev libxml2-dev libcurl4-openssl-dev \
    zip unzip git \
    && docker-php-ext-install intl gd opcache pdo_mysql zip mbstring bcmath

# Set DocumentRoot to /public
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Enable .htaccess and suppress FQDN warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
RUN printf '<Directory /var/www/html/public>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>\n' >> /etc/apache2/sites-available/000-default.conf

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
# Create necessary directories and set permissions
RUN mkdir -p var/cache var/log var/sessions public/uploads/events public/uploads/articles public/uploads/users \
    && chown -R www-data:www-data var/ public/uploads/ \
    && chmod -R 777 var/ public/uploads/

# Verify that the public folder exists (this will show up in your Render logs)
RUN ls -la /var/www/html/public

EXPOSE 80
CMD ["apache2-foreground"]
