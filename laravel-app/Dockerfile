FROM php:8.0-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip git unzip && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo pdo_mysql

# MongoDB setup
RUN apt-get update && apt-get install -y wget gnupg && \
    wget -qO - https://www.mongodb.org/static/pgp/server-4.4.asc | apt-key add - && \
    echo "deb http://repo.mongodb.org/apt/debian buster/mongodb-org/4.4 main" | tee /etc/apt/sources.list.d/mongodb-org-4.4.list && \
    apt-get update && apt-get install -y libssl-dev mongodb-org openssl && \
    pecl install mongodb && docker-php-ext-enable mongodb

# Install Debugger
RUN pecl install xdebug && \
    docker-php-ext-enable xdebug


RUN echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Install Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Install Node.js and npm
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs

# Copy start script into the container
COPY start.sh /start.sh

# Set the start script as the entry point
ENTRYPOINT ["/start.sh"]
# Install Laravel Echo Server
RUN npm install -g laravel-echo-server


# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www

# Copy all Laravel files into the container
COPY . /var/www

# Install Laravel dependencies
RUN composer install --no-scripts


# Expose port 9000 to interact with the app
EXPOSE 9000
EXPOSE 9003
EXPOSE 6379
EXPOSE 6001

