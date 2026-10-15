const http = require('node:http');

const server = http.createServer((req, res) => {
    const pathname = new URL(req.url, 'http://localhost').pathname;

    res.setHeader('Content-Type', 'text/plain; charset=utf-8');

    if (req.method === 'GET' && pathname === '/') {
        res.statusCode = 200;
        res.end('Bienvenue sur le serveur Node');
    } else if (req.method === 'GET' && pathname === '/hello') {
        res.statusCode = 200;
        res.end('Hello World');
    } else if (req.method === 'GET' && pathname === '/time') {
        res.statusCode = 200;
        res.end(new Date().toISOString());
    } else {
        res.statusCode = 404;
        res.end('Route inconnue');
    }
});

const port = process.env.PORT || 3000;
server.listen(port, () => {
    console.log(`Serveur lancer sur http://localhost:${port} '`);
})
