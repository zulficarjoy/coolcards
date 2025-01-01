# Use the official PHP image with Apache
FROM php:8.0-apache

# Install PDO MySQL extension
RUN docker-php-ext-install pdo pdo_mysql

# Copy application files to the Apache document root
COPY . /var/www/html/

# Copy the .env file
COPY .env /var/www/html/.env

# Set environment variables
# ENV DB_HOST=dbhost
# ENV DB_NAME=dbname
# ENV DB_USER=dbuser
# ENV DB_PASS=dbpass

# Enable mod_rewrite
RUN a2enmod rewrite