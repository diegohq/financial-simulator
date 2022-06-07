FROM node:16

WORKDIR /var/www/html

RUN npm config set cache /tmp --global
RUN chown -R 1000:1000 /tmp
