FROM ubuntu:18.04

ARG DEBIAN_FRONTEND=noninteractive
RUN apt update
RUN apt install software-properties-common -y
RUN add-apt-repository ppa:ondrej/php
RUN apt update
RUN apt install -y nginx php php-fpm php-mysql php-curl php-mbstring php-xml
RUN mkdir -p /var/www/html/web-shop-api
COPY nginx.conf /etc/nginx/sites-available/default
COPY entry.sh /entry.sh 
RUN chmod 777 /entry.sh
RUN chmod +x entry.sh
ENTRYPOINT ["/entry.sh"]
