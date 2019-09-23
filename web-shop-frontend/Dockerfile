FROM node:9-alpine

RUN mkdir -p /var/www/html/web-shop-frontend
COPY entry.sh /entry.sh 
RUN chmod 777 /entry.sh
RUN chmod +x entry.sh
ENTRYPOINT ["/entry.sh"]