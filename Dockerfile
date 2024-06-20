# Use the official PHP Apache base image
FROM php:apache

# Install the required PHP extensions for MySQL
RUN docker-php-ext-install mysqli

# Enable mod_rewrite for Apache
RUN a2enmod rewrite

# Set the working directory
WORKDIR /var/www/html/

# Copy the current directory contents into the container
COPY . /var/www/html/

# Set proper permissions for the web root
RUN chown -R www-data:www-data /var/www/html

# Expose port 80 and 443
EXPOSE 80
EXPOSE 443
