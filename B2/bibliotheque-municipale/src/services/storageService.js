const fs = require('fs');
const path = require('path');

const booksFilePath = path.join(__dirname, '../../data/books.json');

function loadBooks() {
    try {
        const fileContent = fs.readFileSync(booksFilePath, 'utf8');
        const books = JSON.parse(fileContent);

        if (!Array.isArray(books)) {
            throw new Error('Le contenu de books.json doit être un tableau.');
        }

        return books;
    } catch (error) {
        if (error.code === 'ENOENT') {
            return null;
        }

        throw new Error(`Impossible de lire data/books.json : ${error.message}`);
    }
}

function saveBooks(books) {
    try {
        fs.writeFileSync(booksFilePath, `${JSON.stringify(books, null, 2)}\n`, 'utf8');
    } catch (error) {
        throw new Error(`Impossible d'écrire data/books.json : ${error.message}`);
    }
}

module.exports = { loadBooks, saveBooks };