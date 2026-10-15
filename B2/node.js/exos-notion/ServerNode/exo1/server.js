const http = require('http');

const hostname = 'localhost';
const port = 3000;

const server = http.createServer((request, response) => {
	response.writeHead(200, { 'Content-Type': 'text/plain; charset=utf-8' });
	response.end('Bonjour, bienvenue sur mon serveur !');
});

server.listen(port, hostname, () => {
	console.log(`Serveur démarré sur http://${hostname}:${port}`);
});

server.on('request', (request, response) => {
    response.writeHead(200, { 'Content-Type': 'text/plain; charset=utf-8' });
    response.end(`${request.method} ${request.url}`);
    console.log(`Requête reçue : ${request.method} ${request.url}`);
});
