FROM node:18

WORKDIR /app

COPY package.json .
RUN npm install

COPY . .

EXPOSE 3000

CMD ["tail", "-f", "/dev/null"]

# docker run -d --name inception-node `
#   -p 3000:3000 `
#   -v "${PWD}\inception_node:/app" `
#   -v /app/node_modules `
#   -v app_uploads:/app/uploads `
#   -v "${PWD}\inception_node\config.json:/app/config.json:ro" `
#   inception-node