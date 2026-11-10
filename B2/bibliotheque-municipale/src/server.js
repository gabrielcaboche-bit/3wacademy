const app = require('./app');
const bookService = require('./services/bookService');

const port = 3000;

try {
    bookService.initializeBooks();
    app.listen(port, () => {
        console.log(`Bibliothèque municipale disponible sur http://localhost:${port}`);
    });
} catch (error) {
    console.error(error.message);
    process.exitCode = 1;
}