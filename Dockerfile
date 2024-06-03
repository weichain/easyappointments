# Use the php:7.4-apache base image
FROM php:7.4-apache

# Set the working directory
WORKDIR /var/www/html

# Prevent interactive prompts during package installation
ARG DEBIAN_FRONTEND=noninteractive

# Install necessary packages and PHP extensions
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd gettext mysqli pdo_mysql

# Install and enable Xdebug
RUN pecl install xdebug-3.1.5 \
    && docker-php-ext-enable xdebug

# Enable Apache rewrite module
RUN a2enmod rewrite

# Copy over custom php.ini configuration
COPY ./docker/server/php.ini /usr/local/etc/php/conf.d/99-overrides.ini

# Expose port 80
EXPOSE 8000

# Copy the application code from the host to the container
COPY ./ /var/www/html
