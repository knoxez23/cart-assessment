FROM php:8.1-fpm
RUN docker-php-ext-install pdo pdo_mysql
WORKDIR /var/www
COPY . .
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]