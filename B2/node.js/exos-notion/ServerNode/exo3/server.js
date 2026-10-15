const http = require('http');
const fs = require('fs');
const path = require('path');

const hostname = 'localhost';
const port = 3000;

const server = http.createServer((request, response) => {
	fs.readFile(path.join(__dirname, 'index.html'), (error, html) => {
		if (error) {
			response.writeHead(500, { 'Content-Type': 'text/plain; charset=utf-8' });
			response.end('Impossible de charger la page HTML.');
			return;
		}

		response.writeHead(200, { 'Content-Type': 'text/html; charset=utf-8' });
		response.end(html);
	});
});

server.listen(port, hostname, () => {
	console.log(`Serveur démarré sur http://${hostname}:${port}`);
});
