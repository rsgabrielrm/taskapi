FROM php:8.2-fpm

# Instalando as dependências necessárias para o projeto
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libpq-dev git curl libxml2-dev zip unzip && docker-php-ext-install pdo_mysql

# Instalando o Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definindo o diretório de trabalho
WORKDIR /var/www

# Copiando os arquivos do projeto para o container
COPY . /var/www

RUN chown -R www-data:www-data /var/www

# Instalando as dependências do projeto via Composer
RUN composer install

CMD php artisan serve --host=0.0.0.0 --port=8000

EXPOSE 8000
