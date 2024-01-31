FROM node:18.15.0-alpine
WORKDIR /var/react

COPY package*.json ./

RUN npm install

COPY . .
EXPOSE 3000
CMD ["npm", "run", "dev"]
