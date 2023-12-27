# PHP-FPM
FROM php:8.2-fpm-alpine3.17 as fpm

COPY ./docker/php/fpm/conf.d/* $PHP_INI_DIR/conf.d

COPY / /var/www/html

WORKDIR /var/www/html

COPY --from=composer:2.2 /usr/bin/composer /usr/local/bin/composer

EXPOSE 9000

# NGINX
FROM nginx:1.20.2-alpine as nginx

COPY docker/nginx/conf.d/* /etc/nginx/conf.d

COPY / /var/www/html/web

ARG PHP_UPSTREAM_CONTAINER=php-fpm
ARG PHP_UPSTREAM_PORT=9000
RUN echo "upstream php-upstream { server ${PHP_UPSTREAM_CONTAINER}:${PHP_UPSTREAM_PORT}; }" > /etc/nginx/conf.d/upstream.conf

EXPOSE 80