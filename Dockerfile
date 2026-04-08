FROM php:8.2-apache

# Install MySQL extension for RDS
RUN docker-php-ext-install pdo pdo_mysql

# Copy all project files
COPY . /var/www/html/

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80