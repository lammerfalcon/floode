FROM node:18-alpine

ARG DOCKER_GROUP_ID
ARG DOCKER_USER_ID
ARG CUSTOM_VITE_PORT

WORKDIR /var/www/floode

USER root

RUN apk --no-cache add shadow && usermod -u $DOCKER_USER_ID node && groupmod -g $DOCKER_GROUP_ID node

COPY front/package*.json ./

RUN npm install -g npm@latest
RUN npm install -g npm-check-updates@latest

RUN npm i

# Fix user permissions
RUN chown -R node:node /var/www/floode && \
    chmod 755 /var/www/floode

USER node

COPY . .

EXPOSE $CUSTOM_VITE_PORT

CMD [ "npm", "run", "dev" ]
