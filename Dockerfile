# Use the official PHP Apache base image
FROM php:8.1.1-apache

WORKDIR /var/www/html/
# Install mysqli extension
RUN docker-php-ext-install mysqli

COPY . /var/www/html/

EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
