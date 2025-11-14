# Usamos a imagem oficial do PHP 8.4-FPM (Alpine é leve)
FROM php:8.4-fpm-alpine

# Instalação de dependências do sistema e extensões PHP comuns para Laravel
RUN apk update && apk add --no-cache \
    # Dependências do sistema
    postgresql-dev \
    git \
    unzip \
    # Extensões PHP para Laravel
    && docker-php-ext-install pdo pdo_pgsql \
    # Instalação do GD (opcional, mas comum para manipular imagens)
    && apk add --no-cache libpng-dev \
    && docker-php-ext-install gd

# Instalação do Composer Globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalação Global do Laravel Installer (CRUCIAL para 'laravel new')
# Adiciona o diretório do instalador ao PATH
RUN composer global require laravel/installer
ENV PATH "$PATH:/root/.composer/vendor/bin"

# Define o diretório de trabalho. O volume no compose irá mapear o './src' para este local.
WORKDIR /var/www/html

# Ajusta permissões (importante no Docker/WSL)
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 /var/www/html

# Expor a porta 9000 para comunicação com o Nginx
EXPOSE 9000

CMD ["php-fpm"]