FROM php:8.2-apache

# Instalar extensões do Linux necessárias para o Laravel e PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql zip

# Ativar o mod_rewrite do Apache (para as rotas do Laravel funcionarem)
RUN a2enmod rewrite

# Apontar o servidor Apache para a pasta /public do Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Instalar o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir a pasta de trabalho
WORKDIR /var/www/html

# Copiar os arquivos do seu backend para dentro do servidor
COPY . .

# Instalar as dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Dar permissão para o Laravel salvar imagens e logs
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Comando final: Roda as tabelas no banco e liga o servidor web
CMD php artisan migrate:fresh --force && apache2-foreground