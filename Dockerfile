FROM php:7.0-apache

RUN mkdir /var/www/sonos-app
WORKDIR /var/www/sonos-app

ENV APACHE_DOCUMENT_ROOT /var/www/sonos-app/web

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN apt-get update
RUN apt-get upgrade -y
RUN apt-get install -y libxml2-dev

RUN docker-php-ext-install soap
RUN docker-php-ext-install sockets

RUN apt-get install -y wget

COPY install-composer.sh ./
RUN chmod +x install-composer.sh
RUN ./install-composer.sh

RUN apt-get install -y git
RUN apt-get install -y zip

COPY app/composer.json ./app/
RUN chown -R www-data:www-data /var/www/sonos-app

USER www-data
RUN php composer.phar install -d ./app
USER root
RUN rm composer.phar

COPY ./ ./
RUN chown -R www-data:www-data /var/www/sonos-app
