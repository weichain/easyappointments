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
# Build the application
RUN npm run build



FROM php:8.0-apache

MAINTAINER Alex Tselegidis (alextselegidis.com)

ENV VERSION="1.4.3"
ENV BASE_URL="http://localhost"
ENV LANGUAGE="english"
ENV DEBUG_MODE=""
ENV DB_HOST=""
ENV DB_NAME=""
ENV DB_USERNAME=""
ENV DB_PASSWORD=""
ENV GOOGLE_SYNC_FEATURE=""
ENV GOOGLE_PRODUCT_NAME=""
ENV GOOGLE_CLIENT_ID=""
ENV GOOGLE_CLIENT_SECRET=""
ENV GOOGLE_API_KEY=""
ENV PROTOCOL=""
ENV SMTP_AUTH=""
ENV SMTP_HOST=""
ENV SMTP_USER=""
ENV SMTP_PASS=""
ENV SMTH_CRYPTO=""
ENV SMTP_PORT=

EXPOSE 80

WORKDIR /var/www/html

COPY ./docker/99-overrides.ini /usr/local/etc/php/conf.d

# Copy the entrypoint script
COPY ./docker/docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
# COPY ./easyappointments-0.0.0.zip .
COPY --from=build-stage /app/easyappointments-0.0.0.zip /var/www/html

# Give execute permissions to the entrypoint script
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

RUN apt-get update \
    && apt-get install -y libfreetype-dev libjpeg62-turbo-dev libpng-dev unzip wget nano \
    && curl -sSL https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions -o - | sh -s \
      curl gd mbstring mysqli xdebug gettext \
    && docker-php-ext-enable xdebug \
    # && wget https://github.xcom/weichain/easyappointments/releases/download/v0.0.0-test/easyappointments-0.0.0.zip \
    && unzip easyappointments-0.0.0.zip \
    && rm easyappointments-0.0.0.zip \
    && echo "alias ll=\"ls -al\"" >> /root/.bashrc \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \
    && chown -R www-data:www-data .

ENTRYPOINT ["docker-entrypoint.sh"]
