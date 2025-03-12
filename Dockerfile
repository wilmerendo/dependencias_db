# Usa una imagen base oficial de PHP con Apache
FROM php:8.1.10-apache

# Actualiza e instala dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    default-mysql-client

# Instala extensiones de PHP necesarias
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd mysqli

# Habilita el módulo de reescritura de Apache para Laravel/Symfony
RUN a2enmod rewrite

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Instala Composer
COPY . .

# Configura permisos
RUN chown -R www-data:www-data /var/www/html

# Expone el puerto 80
EXPOSE 80

# Comando por defecto para iniciar Apache
CMD ["apache2-foreground"]