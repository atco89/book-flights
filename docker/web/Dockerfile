FROM php:8.2-apache

# Set maintainer.
MAINTAINER Aleksandar Rakić <aleksandar.rakic@yahoo.com>

# Copy custom apache configuration.
COPY ./docker/web/config/dev.conf /etc/apache2/sites-enabled/dev.conf

# Update and install required os packages.
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libwebp-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libxpm-dev \
    libfreetype6-dev \
    libzip-dev \
    libsodium-dev \
    libicu-dev \
    zlib1g-dev \
    nodejs \
    npm

# Configure gd extension.
RUN docker-php-ext-configure intl

RUN docker-php-ext-configure gd --with-jpeg --with-freetype

# Install php extensions.
RUN docker-php-ext-install pdo \
    pdo_mysql \
    gd \
    sodium \
    zip \
    intl

# Install composer.
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

# Enable rewrite and ssl mode.
RUN a2enmod rewrite

# Make port 80 available to the world outside this container.
EXPOSE 80

# Set working directory.
WORKDIR /var/www/html
