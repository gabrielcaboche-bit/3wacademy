const bookService = require('../services/bookService');

function parseBookId(value) {
    if (!/^\d+$/.test(value) || Number(value) < 1 || !Number.isSafeInteger(Number(value))) {
        const error = new Error("L'identifiant doit être un entier positif valide.");
        error.statusCode = 400;
        throw error;
    }
    return Number(value);
}

function getBooks(req, res) {
    res.status(200).json(bookService.getBooks());
}

function getBook(req, res, next) {
    try {
        const book = bookService.getBookById(parseBookId(req.params.id));
        if (!book) {
            return res.status(404).json({
                error: 'Livre introuvable.'
            });
        }
        return res.status(200).json(book);
    } catch (error) {
        return next(error);
    }
}

function createBook(req, res, next) {
    try {
        const book = bookService.addBook(req.body);
        return res.status(201).json(book);
    } catch (error) {
        return next(error);
    }
}

function updateBook(req, res, next) {
    try {
        const id = parseBookId(req.params.id);
        const book = bookService.updateBook(id, req.body);
        return res.status(200).json(book);
    } catch (error) {
        return next(error);
    }
}

function deleteBook(req, res, next) {
    try {
        const deletedBook = bookService.deleteBook(parseBookId(req.params.id));
        return res.status(200).json({
            message: 'Livre supprimé avec succès.',
            book: deletedBook
        });
    } catch (error) {
        return next(error);
    }
}

module.exports = {
    getBooks,
    getBook,
    createBook,
    updateBook,
    deleteBook
};