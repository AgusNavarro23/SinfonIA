FROM php:8.2-cli

WORKDIR /app

COPY . /app

# Instala extensiones PHP comunes (opcional)
RUN apt-get update && apt-get install -y \
    zip unzip curl && docker-php-ext-install pdo_mysql

EXPOSE 10000

CMD ["php", "-S", "0.0.0.0:10000", "-t", "."]
