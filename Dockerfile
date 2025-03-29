FROM php:8.2-cli

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

# Copy composer files first
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-scripts --no-autoloader

# Copy the rest of the application
COPY . .

# Generate optimized autoloader
RUN composer dump-autoload --optimize

# Make serve script executable
RUN chmod +x ./serve

# Expose port for Render
ENV PORT=8000
EXPOSE $PORT

# Start command for Render
CMD ["./serve"]
