FROM php:7.0-apache

ADD ./ /var/www/

# Change Apache DocumentRoot
RUN sed -ri -e 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!/var/www/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Enable path rewriting
RUN a2enmod rewrite
RUN service apache2 restart