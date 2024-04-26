# Use Alpine Linux as the base image
FROM php:8.2-fpm-alpine

# Install necessary packages nginx & supervisor
RUN apk update && apk add \
    nginx \
    supervisor \
    htop \
    libpq-dev

RUN docker-php-ext-install pdo pdo_pgsql

# Installing composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create directory where nginx logs will be stored
# Create directory where php-fpm logs will be stored
RUN mkdir -p /var/log/nginx \
    && mkdir -p /var/log/php-fpm

# Copy the Laravel application files to the container
COPY --chown=www-data:www-data . /var/www/html

# Set the working directory inside the container
WORKDIR /var/www/html

# RUN composer install --no-interaction
RUN composer install --no-interaction

# Set up nginx
COPY default.conf /etc/nginx/http.d/default.conf
COPY nginx.conf /etc/nginx/nginx.conf 

# Set up php-fpm
COPY zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf

# Set up Supervisor
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Export ports : default port for HTTP traffic
EXPOSE 80

# Start Supervisor
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
