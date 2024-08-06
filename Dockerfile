FROM  hub.kripton.az/private/php:8.2-ubuntu

WORKDIR /var/www/html/

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

COPY . .

RUN composer install
RUN apt-get update
RUN apt-get install -y mc vim

ENTRYPOINT ["php","artisan","serve","--host","0.0.0.0","--port","8000"]
