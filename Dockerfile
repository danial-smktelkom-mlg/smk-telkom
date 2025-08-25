# Use PHP-FPM Alpine for a smaller footprint
FROM php:8.2-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    nginx \
    supervisor \
    $PHPIZE_DEPS

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-enable mysqli

# Configure nginx
COPY nginx.conf /etc/nginx/http.d/default.conf

# Configure supervisord
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Create directory for PHP-FPM socket
RUN mkdir -p /var/run/php-fpm

# Set working directory
WORKDIR /var/www/html

# Copy source code
COPY . /var/www/html

# Fix permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod -R 777 /var/www/html/assets/data

# Create volume for persistent data
VOLUME ["/var/www/html/assets/data"]

# Expose port 80
EXPOSE 80

# Health check
HEALTHCHECK --interval=30s --timeout=3s \
    CMD curl -f http://localhost/ || exit 1

# Start supervisord
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
