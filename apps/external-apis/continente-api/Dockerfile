FROM php:8.3-cli

WORKDIR /app

# dependências básicas + pdo_mysql
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libzip-dev \
 && docker-php-ext-install pdo_mysql \
 && docker-php-ext-install zip \
 && rm -rf /var/lib/apt/lists/*

# composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# copia o projeto
COPY . .

# instala dependências
RUN composer install --no-interaction --prefer-dist

# copia o entrypoint
COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

EXPOSE 80

ENTRYPOINT ["/entrypoint.sh"]
