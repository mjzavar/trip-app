# Set the base image for subsequent instructions
FROM php:8.2-fpm

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    unzip \
    git \
    libzip-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev && \
    docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

ENV COMPOSER_ALLOW_SUPERUSER=1


# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
# Set working directory
WORKDIR /var/www

# Remove default server definition
RUN rm -rf /var/www/html

# Copy existing application directory contents
COPY .. /var/www

# Copy existing application directory permissions
#COPY --chown=www-data:www-data .. /var/www

RUN chmod -R 775 /var/www
RUN chown -R www-data:www-data /var/www


# Change current user to www
USER www-data

RUN composer install --no-interaction
RUN composer dump-autoload


# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
