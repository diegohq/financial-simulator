FROM php:8.1

WORKDIR /var/www/html

# Update system
RUN apt-get update

# Install zip
RUN apt-get install -y zip unzip libzip-dev
RUN docker-php-ext-install zip

# Install Postgres
RUN apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY . .

ENTRYPOINT [ "php" ]
