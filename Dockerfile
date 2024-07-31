FROM php:8.1.0-apache
WORKDIR /var/www/html

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Instalar librerías y extensiones necesarias
RUN apt-get update -y && apt-get install -y \
    libicu-dev \
    libmariadb-dev \
    unzip zip \
    zlib1g-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    git \
    # Necesario para ejecutar Composer
    libzip-dev

# Copiar el contenido de la aplicación
COPY . /var/www/html

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar extensiones PHP
RUN docker-php-ext-install gettext intl pdo_mysql gd

# Configurar la extensión GD
RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# Copiar y habilitar la configuración de Apache
COPY my_apache_config.conf /etc/apache2/sites-available/my_apache_config.conf
RUN a2ensite my_apache_config.conf
RUN a2dissite 000-default.conf

# Agregar ServerName a la configuración global de Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Exponer el puerto 80
EXPOSE 80

# Instalar dependencias de Composer y ejecutar comandos Artisan
RUN composer install --no-dev --optimize-autoloader \
    && chown -R www-data:www-data /var/www/html \
    && find /var/www/html/storage -type d -exec chmod 755 {} \; \
    && find /var/www/html/storage -type f -exec chmod 644 {} \; \
    && find /var/www/html/bootstrap/cache -type d -exec chmod 755 {} \; \
    && find /var/www/html/bootstrap/cache -type f -exec chmod 644 {} \; \
    && php artisan cache:clear \
    && php artisan config:clear \
    && php artisan config:cache \
    && php artisan route:clear \
    && php artisan view:clear

# Comando por defecto
ENTRYPOINT ["docker-php-entrypoint"]
CMD ["apache2-foreground"]
