# Use an official PHP runtime as a parent image
FROM php:8.1-apache

# Set working directory
WORKDIR /var/www/html

# Copy the application code into the container
COPY . /var/www/html

# Install PHP extensions required by your project
RUN docker-php-ext-install pdo pdo_mysql

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose port 80 to allow external access
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
