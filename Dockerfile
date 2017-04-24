FROM invartam/docker-alpine-php-fpm-advanced

COPY . /app
WORKDIR /app

RUN apk add wget \
    && wget https://getcomposer.org/composer.phar \
    && php composer.phar install \
    && rm composer.phar

EXPOSE 80
