FROM php:8.0-fpm

COPY wait-for-it.sh /usr/bin/wait-for-it

RUN usermod -u 1000 www-data

RUN chmod +x /usr/bin/wait-for-it

RUN apt-get update && \
    apt-get install -y --no-install-recommends libssl-dev zlib1g-dev libpng-dev curl git unzip netcat libxml2-dev libpq-dev libzip-dev && \
    pecl install apcu xdebug && \
    docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
    docker-php-ext-install -j$(nproc) zip opcache intl pdo_pgsql  pdo_mysql exif gd pgsql && \
    docker-php-ext-enable apcu pdo_pgsql pdo_mysql sodium xdebug gd exif && \
    apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN echo "Europe/Paris" > /etc/timezone

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

CMD composer i -o ; wait-for-it db:5432 -- bin/console doctrine:migrations:migrate -n;  php-fpm

EXPOSE 9000 9003
