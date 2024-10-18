# Use the official PHP image with Apache
FROM php:7.4-apache

# Install necessary extensions for MySQL and PHP
RUN docker-php-ext-install mysqli

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy your PHP app to the container
COPY . /var/www/html/

# Set proper permissions for the web files
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose port 80 to access the web application
EXPOSE 8081
