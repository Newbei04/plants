FROM php:8.2-apache

# Enable Apache rewrite (optional but common for PHP apps)
RUN a2enmod rewrite

# Copy your project files into the container
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80
