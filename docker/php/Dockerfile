FROM php:8.0.8-apache-buster
LABEL maintainer="bell.tanaka@karabiner.tech"

COPY ./docker/php/php.ini /usr/local/etc/php/
COPY ./docker/php/opcache.ini /usr/local/etc/php/conf.d/
COPY ./docker/conf/000-default.conf /etc/apache2/sites-available/

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_NO_INTERACTION 1
ENV COMPOSER_MEMORY_LIMIT -1
ENV COMPOSER_HOME /composer

RUN apt-get update \
    && apt-get install -y \
    wget \
    unzip \
    git \
    openssl \
    libssl-dev \
    zlib1g-dev \
    libonig-dev \
    libicu-dev \
    && docker-php-ext-install -j$(nproc) \
    intl \
    opcache \
    && pecl install crypto-0.3.2 apcu xdebug \
    && docker-php-ext-enable crypto apcu xdebug \
    && cp /usr/share/zoneinfo/Asia/Tokyo /etc/localtime \
    && apt-get autoremove -y \
    && apt-get clean -y \
    && pecl clear-cache \
    && rm -rf /var/lib/apt/lists/* \
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer \
    && a2enmod rewrite

WORKDIR /var/www/html
