FROM shinsenter/php:8.4-fpm-apache

ENV APP_PATH=/app
ENV DOCUMENT_ROOT=public

WORKDIR /app

COPY . /app

RUN mkdir -p /app/writable/cache /app/writable/session /app/writable/logs \
 && chmod -R a+rwX /app/writable

EXPOSE 80