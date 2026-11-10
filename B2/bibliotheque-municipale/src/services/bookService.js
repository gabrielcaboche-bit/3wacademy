const bookEvents = require('../events/bookEvents');
const storageService = require('./storageService');

let books = [];

function createError(message, statusCode) {
    const error = new Error(message);
    error.statusCode = statusCode;
    return error;
}

function initializeBooks() {
    const savedBooks = storageService.loadBooks();
    books = savedBooks || [];
}

function getBooks() {
    return books;
}

function getBookById(id) {
    return books.find((book) => book.id === id) || null;
}

function validateBookFields(fields, {isUpdate = false} = {}) {
    const allowedFields = ['titre', 'auteur', 'disponible'];
    const fieldNames = Object.keys(fields);

    if (fieldNames.some((field) => !allowedFields.includes(field))) {
        throw createError("Seuls les champs 'titre', 'auteur' et 'disponible' sont autorisés.", 400);
    }

    if (isUpdate && fieldNames.length === 0) {
        throw createError('Au moins un champ doit être fourni pour modifier le livre.', 400);
    }

    for (const field of ['titre', 'auteur']) {
        if (Object.hasOwn(fields, field) &&
            (typeof fields[field] !== 'string' || fields[field].trim().length === 0)) {
            throw createError(`Le champ '${field}' doit être une chaîne non vide.`, 400);
        }
    }

    if (Object.hasOwn(fields, 'disponible') && typeof fields.disponible !== 'boolean') {
        throw createError("Le champ 'disponible' doit être un booléen.", 400);
    }
}

function persistBooks() {
    storageService.saveBooks(books);
}

function addBook(fields) {
    if (!fields || typeof fields !== 'object' || Array.isArray(fields)) {
        throw createError('Le corps de la requête doit être un objet JSON.', 400);
    }

    validateBookFields(fields);
    if (!Object.hasOwn(fields, 'titre') || !Object.hasOwn(fields, 'auteur')) {
        throw createError("Les champs 'titre' et 'auteur' sont obligatoires.", 400);
    }

    const nextId = books.reduce((maximumId, book) => Math.max(maximumId, book.id), 0) + 1;
    const book = {
        id: nextId,
        titre: fields.titre.trim(),
        auteur: fields.auteur.trim(),
        disponible: fields.disponible === undefined ? true : fields.disponible
    };

    books.push(book);
    persistBooks();
    bookEvents.emit('book:added', book);
    return book;
}

function updateBook(id, fields) {
    const book = getBookById(id);
    if (!book) {
        throw createError('Livre introuvable.', 404);
    }
    if (!fields || typeof fields !== 'object' || Array.isArray(fields)) {
        throw createError('Le corps de la requête doit être un objet JSON.', 400);
    }

    validateBookFields(fields, {
        isUpdate: true
    });
    for (const field of ['titre', 'auteur', 'disponible']) {
        if (Object.hasOwn(fields, field)) {
            book[field] = typeof fields[field] === 'string' ? fields[field].trim() : fields[field];
        }
    }

    persistBooks();
    return book;
}

function deleteBook(id) {
    const bookIndex = books.findIndex((book) => book.id === id);
    if (bookIndex === -1) {
        throw createError('Livre introuvable.', 404);
    }

    const [deletedBook] = books.splice(bookIndex, 1);
    persistBooks();
    bookEvents.emit('book:deleted', deletedBook);
    return deletedBook;
}

module.exports = {
    initializeBooks,
    getBooks,
    getBookById,
    addBook,
    updateBook,
    deleteBook
};