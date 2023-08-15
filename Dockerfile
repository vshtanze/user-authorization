FROM php:8.1-fpm

USER root

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN apt update

RUN pecl install xdebug-3.1.5
RUN docker-php-ext-enable xdebug

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip \
    git
RUN docker-php-ext-install zip

WORKDIR /var/www/app