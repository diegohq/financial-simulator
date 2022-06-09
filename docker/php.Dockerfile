FROM php:8.1-fpm

ARG PORT=9000

RUN sed -i "s/9000/$PORT/" /usr/local/etc/php-fpm.d/zz-docker.conf

WORKDIR /var/www/html

# Update system
RUN apt-get -y update

# Install Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Install zip
RUN apt-get install -y zip unzip libzip-dev
RUN docker-php-ext-install zip

# Install Postgres
RUN apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql

COPY . .

RUN composer install

RUN addgroup --gid 1000 laravel
RUN adduser --ingroup laravel --shell /bin/sh laravel

USER laravel

EXPOSE $PORT
