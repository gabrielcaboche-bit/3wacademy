const http = require('http');
const fs = require('fs');
const path = require('path');

const hostname = 'localhost';
const port = 3000;

const server = http.createServer((request, response) => {
	fs.readFile(path.join(__dirname, 'personne.json'), (error, json) => {
		if (error) {
			response.writeHead(500, { 'Content-Type': 'text/plain; charset=utf-8' });
			response.end('Impossible de charger le fichier JSON.');
			console.error(`Erreur lors de la lecture du fichier JSON : ${error.message}`);
			return;
		}

		response.writeHead(200, { 'Content-Type': 'application/json; charset=utf-8' });
		response.end(json);
		console.log(`Fichier JSON servi le user-agent : ${request.headers['user-agent']}`);
	});
});

server.listen(port, hostname, () => {
	console.log(`Serveur démarré sur http://${hostname}:${port}`);
});
