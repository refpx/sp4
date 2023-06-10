FROM php:7.4.33-apache-buster

# Actualizar el sistema operativo y paquetes existentes
RUN apt-get update && apt-get upgrade -y

# Instalar extensiones y paquetes adicionales
RUN apt-get install -y libzip-dev zip \
  && docker-php-ext-install zip pdo_mysql mysqli

# Configurar opciones de PHP y Apache
RUN a2enmod rewrite

# Establecer permisos para Apache
RUN chmod 777 /var/www/html -R
