# Stage 1: PHP-FPM
FROM php:8.2-fpm-alpine

# Install extensions jika perlu (misal untuk CSV, PDF)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy seluruh source ke container
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Stage 2: Nginx
FROM nginx:alpine

# Copy source dari stage 1
COPY --from=0 /var/www/html /var/www/html

# Copy konfigurasi Nginx custom
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Expose port 80
EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
