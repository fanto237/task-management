FROM php:7.4-fpm
RUN apt-get upgrade && apt-get update


# install 
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN pecl install redis && docker-php-ext-enable redis