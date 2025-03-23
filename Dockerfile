# Use the official PHP image with Apache
FROM php:7.4-apache

# Install necessary PHP extensions
RUN docker-php-ext-install mysqli

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set the working directory inside the container
WORKDIR /var/www/html

# Copy the PHP app files to the container
COPY . /var/www/html/

# Set proper permissions for the web files
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Correct Apache configuration
RUN echo "<VirtualHost *:80>\n\
    DocumentRoot /var/www/html\n\
    <Directory /var/www/html/>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
    ErrorLog /var/log/apache2/error.log\n\
    CustomLog /var/log/apache2/access.log combined\n\
</VirtualHost>" > /etc/apache2/sites-available/000-default.conf

# Enable the Apache site configuration
RUN a2ensite 000-default

# Expose the correct port (80)
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
