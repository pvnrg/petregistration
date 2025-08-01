# Use official PHP 8.2 FPM image
FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libicu-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    nodejs \
    npm \
    && docker-php-ext-install pdo pdo_mysql intl zip opcache

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory inside container
WORKDIR /var/www

# Copy all project files into container
COPY . .

# Install PHP dependencies
RUN composer install --no-interaction

# Give permissions to cache & var folders (fixes Symfony permission issues)
RUN chown -R www-data var && chown -R www-data vendor

# Expose port 8000 (Symfony dev server)
EXPOSE 8000

# Start Symfony dev server
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
