# Utilizar una imagen base de PHP con Apache
FROM php:8.2-apache

# Habilitar e instalar extensiones y librerías necesariass
RUN apt-get update -y && \  
    # Instalar los paquetes necesarios
    apt-get install -y \   
    # Biblioteca de desarrollo para manejo de cadenas (ICU)
    libicu-dev \                                                  
    # Biblioteca de desarrollo para MariaDB
    libmariadb-dev \                                             
    # Herramienta para descomprimir archivos ZIP
    unzip \                                                       
    # Herramienta para crear archivos ZIP
    zip \                                                          
    # Biblioteca de desarrollo para compresión de datos (zlib)
    zlib1g-dev \                                                  
    # Biblioteca para manejo de imágenes JPEG
    libjpeg-dev \                                                 
    # Biblioteca para manejo de fuentes TrueType
    libfreetype6-dev \                                           
    # Alternativa para manejo de JPEG con mejoras de rendimiento
    libjpeg62-turbo-dev \                                         
    # Biblioteca para manejo de imágenes PNG
    libpng-dev \                                                  
    # Herramienta de control de versiones (Git)
    git \                                                           
    # Biblioteca para manejo de archivos ZIP en PHP
    libzip-dev && \         
    # Instalar extensiones de PHP necesarias
    docker-php-ext-install mysqli pdo_mysql gettext intl gd && \  
    # Habilitar extensiones de PHP instaladas
    docker-php-ext-enable mysqli pdo_mysql && \                   
    # Habilitar el módulo de reescritura de Apache
    a2enmod rewrite && \                                         
    # Limpiar la caché de apt para reducir el tamaño de la imagen
    apt-get clean && rm -rf /var/lib/apt/lists/*                  

# Copiar el contenido de la aplicación
COPY . /var/www/html

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

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

# Comando por defecto
ENTRYPOINT ["docker-php-entrypoint"]
CMD ["apache2-foreground"]
