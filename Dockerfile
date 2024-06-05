# First stage: Build the frontend and install PHP and Composer
FROM node:14 as build-stage

# Set the working directory
WORKDIR /app

# Copy package.json and package-lock.json to the container
COPY ./package*.json ./

# Install Node.js dependencies
RUN npm install

# Install PHP and Composer
RUN apt-get update && apt-get install -y \
    curl \
    php-cli \
    php-mbstring \
    git \
    unzip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.7.6

ENV COMPOSER_ALLOW_SUPERUSER=1

# Copy the rest of the application code
COPY ./ ./

# Install Composer dependencies
# RUN composer install --no-interaction --no-dev --no-scripts --optimize-autoloader

# Build the application (assumes the build output is in the 'build' directory)
RUN npm run build

# Second stage: Setup PHP environment and serve the application
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
        libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd gettext mysqli pdo pdo_mysql zip

# Install and enable Xdebug
RUN pecl install xdebug-3.1.5 \
    && docker-php-ext-enable xdebug

# Enable Apache rewrite module
RUN a2enmod rewrite

# Copy over custom php.ini configuration
COPY ./docker/server/php.ini /usr/local/etc/php/conf.d/99-overrides.ini

# Copy the built application from the first stage
COPY --from=build-stage /app/build /var/www/html

# Ensure the correct permissions
RUN chmod -R 755 /var/www/html
RUN chown -R www-data:www-data /var/www/html

# Create the log file and ensure the correct permissions
RUN touch /var/log/php_errors.log && chmod 777 /var/log/php_errors.log && chown www-data:www-data /var/log/php_errors.log

# Add Listen directive
RUN echo "Listen 8000" >> /etc/apache2/ports.conf

# Copy custom Apache configuration
COPY ./docker/server/000-default.conf /etc/apache2/sites-available/000-default.conf

# Create test PHP files for debugging
RUN echo "<?php phpinfo(); ?>" > /var/www/html/info.php
RUN echo "<?php trigger_error('This is a test error', E_USER_ERROR); ?>" > /var/www/html/error_test.php
RUN echo "<?php echo 'BASE_URL: ' . getenv('BASE_URL') . '<br>'; ?>" > /var/www/html/envs.php


# Enable site configuration
RUN a2ensite 000-default.conf

# Expose port 8000
EXPOSE 8000

# Start Apache
CMD ["apache2-foreground"]