FROM php:8.1-apache

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN apt-get update && apt-get upgrade -y
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN pecl install xdebug \
&& docker-php-ext-enable xdebug
RUN apt-get install -y net-tools \
    && apt-get clean

RUN apt -y install git
RUN apt -y install nano
RUN a2enmod rewrite
RUN service apache2 start

RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

# # Install Git
# RUN apk --no-cache add git

# # Set the working directory
# WORKDIR /var/www/html/ 

# # Clone your Git repository