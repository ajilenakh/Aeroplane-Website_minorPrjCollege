# The official Apache image with PHP
FROM php:7.4-apache 

# Install dependencies for mysqli
RUN apt-get update && apt-get install -y \
    libmariadb-dev \
    && docker-php-ext-install mysqli

# Set the working directory to the Apache server's document root
WORKDIR /var/www/html