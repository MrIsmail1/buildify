FROM php:8.2-apache

RUN apt-get update

# Install Postgre PDO
RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql


RUN apt-get update -y && apt-get install -y libpng-dev libfreetype6-dev libyaml-dev

RUN  docker-php-ext-configure gd --with-freetype
RUN  docker-php-ext-install gd

RUN pecl install yamL

RUN usermod -u 1000 www-data

RUN a2enmod rewrite

# Copy the application folder inside the container
COPY ./site /var/www/html

# Copy the script into the container
COPY ./start.sh /usr/local/bin/start.sh

# Give execution permissions
RUN chmod +x /usr/local/bin/start.sh

# Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Change document root for Apache
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Expose port 80 and start apache server
EXPOSE 80
CMD ["start.sh"]