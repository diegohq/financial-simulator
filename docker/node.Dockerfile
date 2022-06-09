FROM node:16

WORKDIR /code/financial-simulator

RUN npm config set cache /tmp --global
RUN chown -R 1000:1000 /tmp

ENTRYPOINT [ "npm" ]
