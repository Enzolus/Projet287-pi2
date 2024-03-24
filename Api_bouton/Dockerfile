FROM node:21-alpine

WORKDIR /usr/src/app

COPY package*.json ./

RUN npm install

COPY app.js .

EXPOSE 5001

CMD ["node", "app.js"]

USER node

HEALTHCHECK --interval=30s --timeout=30s --start-period=5s --retries=3 \
  CMD node --version || exit 1
