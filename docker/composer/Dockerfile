FROM composer:latest

RUN addgroup -g 1337 sail && adduser -G sail -g sail -s /bin/sh -D sail

USER sail

WORKDIR /var/www/html

ENTRYPOINT [ "composer", "--ignore-platform-reqs" ]
