FROM php:8.2-fpm

# Set working directory
WORKDIR /app

# Install dependencies and PHP extensions
RUN apt-get update && apt-get install -y unzip git libzip-dev libxml2-dev libonig-dev libjpeg-dev libpng-dev libfreetype6-dev libicu-dev

# Install PHP docker extensions
RUN docker-php-ext-install pdo pdo_mysql mbstring zip xml intl gd bcmath exif ctype

# Configure installed extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy composer files for caching
COPY composer.json composer.lock /app/

# Install dependencies without application files for caching
RUN composer install --no-scripts --no-autoloader

# Copy application files
COPY . /app/

# Install dependencies with optimized autoloader
RUN composer install --optimize-autoloader

# Make serve script executable
RUN chmod +x ./serve

# Expose default port
EXPOSE 10000

# Default command
CMD ["./serve"]