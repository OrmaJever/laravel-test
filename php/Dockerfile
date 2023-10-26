FROM php:8.2-fpm

WORKDIR /var/www

RUN apt-get update && \
    apt-get install -y git zip wget libpq-dev libcurl3-dev libzip-dev libonig-dev

RUN docker-php-ext-install opcache pdo_pgsql mbstring curl bcmath zip
RUN rm -rf /tmp/pear

COPY php.ini /usr/local/etc/php/conf.d/php.ini
COPY opcache.ini /usr/local/etc/php/conf.d/opcache.ini

WORKDIR /var/www

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer \
        --install-dir=/usr/local/bin && \
        echo "alias composer='composer'" >> /root/.bashrc