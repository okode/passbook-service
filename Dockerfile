# Passbook Service

FROM ubuntu:latest

MAINTAINER Okode <support@okode.com>

ENV TERM linux

RUN apt-get -y update

RUN apt-get install -y software-properties-common && \
    add-apt-repository -y ppa:nginx/stable && \
    apt-get -y update && \
    apt-get install -y nginx && \
    apt-get install -y curl

RUN chown -R www-data:www-data /var/lib/nginx

RUN apt-get install -y php5-fpm

RUN rm -rf /var/lib/apt/lists/*

EXPOSE 80

CMD service php5-fpm start && nginx -g "daemon off;"
