#--- El repositorio docker de php
FROM php:7.2-fpm-alpine
RUN docker-php-ext-install pdo_mysql mysqli

#--- Usar apk en lugar de apt-get para cuando se usa alphine
#--- nota de Cardoso 14-feb-2020

RUN apk update && apk add \
    curl\
    wget\
    zip\
    unzip\
    composer