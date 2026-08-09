FROM php:8.2-apache

# Enable Apache Rewrite Module for clean URLs
RUN a2enmod rewrite

# Install MySQL PDO Driver
RUN docker-php-ext-install pdo pdo_mysql

# Copy project files to Apache root
COPY . /var/www/html/

# Copy Apache configuration and enable it
COPY apache.conf /etc/apache2/conf-available/custom.conf
RUN a2enconf custom

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80