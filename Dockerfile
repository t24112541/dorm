FROM php:7.0-apache
COPY . /var/www/html
RUN docker-php-ext-install mysqli
EXPOSE 81

ENV production true
ENV db_host "0"
ENV db_user "cv"
ENV db_pass "t24112541"


