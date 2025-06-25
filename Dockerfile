# Use official PHP image with Apache
FROM php:8.1-apache

# Copy application files to the Apache root directory
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Install PHP extensions (optional)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Give Apache permissions (optional for uploads/logs)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Enable Apache mod_rewrite if needed
RUN a2enmod rewrite

# Expose port 80 (Apache default)
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]

