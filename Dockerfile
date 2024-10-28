# Dockerfile for Laravel Web Application
FROM php:8.1-fpm

# Install necessary extensions and cron
RUN apt-get update && apt-get install -y \
    libaio1 \
    unzip \
    wget \
    libssl-dev \
    libcurl4-openssl-dev \
    git \
    curl \
    cron  # Install cron

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory
WORKDIR /var/www/mivp2apstpln_webv31

# Copy application code and environment variables
COPY . .

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

# Create the cronjob script to delete old PDFs
RUN echo "find /var/www/mivp2apstpln_webv31/storage/app/public/report -type f -name '*.pdf' -mmin +60 -delete" > /usr/local/bin/cleanup_pdfs.sh && \
    chmod +x /usr/local/bin/cleanup_pdfs.sh

# Add the cronjob to crontab
RUN echo '0 * * * * /usr/local/bin/cleanup_pdfs.sh' > /etc/cron.d/cleanup_pdfs

# Apply cronjob permissions
RUN chmod 0644 /etc/cron.d/cleanup_pdfs

# Register cron job
RUN crontab /etc/cron.d/cleanup_pdfs

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start cron and PHP-FPM
CMD cron && php-fpm
