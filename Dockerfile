FROM invartam/docker-alpine-php-fpm-advanced

COPY src /app

RUN apk update \
    && rm -rf /app/.git /app/.gitignore /app/*.md /app/Dockerfile /app/docker-compose.yml \
    && cd /app/ \
    && cp .env.example .env \
    && chown -R www-data:www-data /app \
    && php artisan vendor:publish \
    && php artisan key:generate

COPY nginx.conf /etc/nginx/nginx.conf

EXPOSE 80
