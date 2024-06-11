# Dockerfile para el contenedor PHP
FROM php:8.1-apache

# Habilitar mod_rewrite para Apache
RUN a2enmod rewrite && \
    # Instalar las extensiones PHP necesarias
    docker-php-ext-install pdo pdo_mysql && \
    # Herramientas adicionales (opcional)
    apt-get update && apt-get install -y \
        git \
        unzip \
    && rm -rf /var/lib/apt/lists/*

# Copiar el código fuente
COPY ./CodigoBarras /var/www/html
