FROM webdevops/php-nginx:7.4-alpine

# Install Laravel framework system requirements (https://laravel.com/docs/8.x/deployment#optimizing-configuration-loading)
RUN apk add --no-cache oniguruma-dev libxml2-dev tzdata musl-locales musl-locales-lang \
    && rm -rf /var/cache/apk/*
RUN docker-php-ext-install \
        bcmath \
        ctype \
        fileinfo \
        json \
        mbstring \
        tokenizer \
        xml

RUN set -eux; \
    apk add --no-cache --virtual .fetch-deps curl; \
    BINARY_URL='https://github.com/AdoptOpenJDK/openjdk17-binaries/releases/download/jdk-2021-01-06-12-46/OpenJDK-jre_x64_alpine-linux_hotspot_2021-01-06-05-34.tar.gz'; \
    curl -LfsSo /tmp/openjdk.tar.gz ${BINARY_URL}; \
    mkdir -p /opt/java/openjdk; \
    cd /opt/java/openjdk; \
    tar -xf /tmp/openjdk.tar.gz --strip-components=1; \
    apk del --purge .fetch-deps; \
    rm -rf /var/cache/apk/*; \
    rm -rf /tmp/openjdk.tar.gz;

# Copy Composer binary from the Composer official Docker image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV WEB_DOCUMENT_ROOT /app/public
ENV APP_ENV production
ENV JAVA_HOME /opt/java/openjdk
ENV PATH "${JAVA_HOME}/bin:${PATH}"

WORKDIR /app

COPY . .

RUN mv docker/location-stats.conf /opt/docker/etc/nginx/vhost.common.d/20-location-stats.conf
RUN mv docker/analysis.conf /opt/docker/etc/supervisor.d
RUN mv docker/analysis.sh /opt/docker/bin/service.d/analysis.sh
RUN mv .env.prod .env

RUN composer install --no-interaction --optimize-autoloader --no-dev
RUN touch database/database.sqlite
RUN php artisan migrate -n --force
RUN php artisan db:seed -n --force
# Optimizing Configuration loading
RUN php artisan config:cache
# Optimizing Route loading
RUN php artisan route:cache
# Optimizing View loading
RUN php artisan view:cache

RUN chown -R application:application .
