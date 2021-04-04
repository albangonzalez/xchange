FROM php:8.0.3-fpm

ARG DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
        libzip-dev \
        zlib1g-dev \
        libicu-dev \
        gettext \
        git \
    && pecl install \
        apcu \
        xdebug \
    && pecl clear-cache \
    && docker-php-ext-configure zip \
    && docker-php-ext-install -j$(nproc) \
        pdo_mysql \
        intl \
        zip \
    && docker-php-ext-enable \
        apcu \
        opcache \
        xdebug


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN curl -s https://get.symfony.com/cli/installer | bash; \
    mv /root/.symfony/bin/symfony /usr/local/bin/symfony;

COPY ./docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

ENTRYPOINT ["docker-entrypoint"]
CMD ["php-fpm"]

WORKDIR /var/www
