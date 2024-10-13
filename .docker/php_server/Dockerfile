## ---------------------------------------------------------
## Utilizar una imagen base de PHP con Apache
## ---------------------------------------------------------

    FROM php:8.2-apache

    ## ---------------------------------------------------------
    ## Argumentos
    ## ---------------------------------------------------------
        
    ARG NEW_UID
    ARG NEW_GID
    ARG MY_USER
    ARG MY_GROUP
        
    ## ---------------------------------------------------------
    ## Habilitar e instalar extensiones y librerías necesarias
    ## ---------------------------------------------------------
        
    RUN set -eux && \
        groupadd -g ${NEW_GID} -r ${MY_GROUP} && \
        useradd -u ${NEW_UID} -m -s /bin/bash -g ${MY_GROUP} ${MY_USER} && \
        apt-get update && apt-get install -y \
        nano \
        libicu-dev \
        libmariadb-dev \
        unzip \
        zip \
        zlib1g-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        git \
        libzip-dev \
        tzdata \
        curl \
        sudo \
        nodejs npm && \
        ln -fs /usr/share/zoneinfo/Europe/Madrid /etc/localtime && \
        dpkg-reconfigure -f noninteractive tzdata && \
        docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg && \
        docker-php-ext-install -j$(nproc) gd mysqli pdo_mysql gettext intl && \
        docker-php-ext-enable mysqli pdo_mysql && \
        a2enmod rewrite && \
        apt-get clean && rm -rf /var/lib/apt/lists/* && \
        curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
        
    ## ---------------------------------------------------------
    ## Copiar el contenido de la aplicación
    ## ---------------------------------------------------------
        
    COPY . /var/www/html
        
    ## ---------------------------------------------------------
    ## Copiar y habilitar la configuración de Apache
    ## ---------------------------------------------------------
        
    COPY ./php_server/host/virtual-host.conf /etc/apache2/sites-available/virtual-host.conf
    RUN a2ensite virtual-host.conf 
    RUN a2dissite 000-default.conf
        
    ## ---------------------------------------------------------
    ## Agregar ServerName a la configuración global de Apache
    ## ---------------------------------------------------------
        
    RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf
        
    ## ---------------------------------------------------------
    ## Exponer el puerto 80
    ## ---------------------------------------------------------
        
    EXPOSE 80
        
    ## ---------------------------------------------------------
    ## Comando por defecto
    ## ---------------------------------------------------------
        
    ENTRYPOINT ["docker-php-entrypoint"]
    CMD ["apache2-foreground"]
    