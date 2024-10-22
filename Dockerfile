# Dockerfile for Laravel Web Application
FROM php:8.1-fpm

# Install necessary extensions
RUN apt-get update && apt-get install -y \
    libaio1 \
    unzip \
    wget \
    libssl-dev \
    libcurl4-openssl-dev \
    git \
    curl

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory
WORKDIR /var/www/mivp2apstpln_webv31

# Copy application code and environment variables
COPY . /var/www/mivp2apstpln_webv31/

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Set permissions
RUN chown -R www-data:www-data /var/www/mivp2apstpln_webv31 && \
    chmod -R 755 /var/www/mivp2apstpln_webv31 && \
    chmod +x /var/www/mivp2apstpln_webv31/artisan && \
    chmod -R 775 /var/www/mivp2apstpln_webv31/storage /var/www/mivp2apstpln_webv31/bootstrap/cache && \
    chown -R www-data:www-data /var/www/mivp2apstpln_webv31/storage /var/www/mivp2apstpln_webv31/bootstrap/cache 

# Run storage:link
RUN php artisan storage:link

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm7.4", "-F"]
