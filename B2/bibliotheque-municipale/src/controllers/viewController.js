const bookService = require('../services/bookService');

function parseBookId(value) {
    if (!/^\d+$/.test(value) || Number(value) < 1 || !Number.isSafeInteger(Number(value))) {
        const error = new Error("L'identifiant doit être un entier positif valide.");
        error.statusCode = 400;
        throw error;
    }
    return Number(value);
}

function showHome(req, res) {
    res.render('index', {
        title: 'Gestion de la bibliothèque municipale',
        books: bookService.getBooks(),
        added: req.query.added === '1',
        error: null
    });
}

function showBook(req, res, next) {
    try {
        const book = bookService.getBookById(parseBookId(req.params.id));
        if (!book) {
            return res.status(404).render('book-detail', {
                title: 'Livre introuvable',
                book: null,
                error: 'Ce livre est introuvable.'
            });
        }
        return res.render('book-detail', {
            title: book.titre,
            book,
            error: null
        });
    } catch (error) {
        return next(error);
    }
}

function createBook(req, res, next) {
    try {
        bookService.addBook({
            titre: req.body.titre,
            auteur: req.body.auteur,
            disponible: req.body.disponible === 'true'
        });
        return res.redirect(303, '/?added=1');
    } catch (error) {
        return res.status(error.statusCode || 500).render('index', {
            title: 'Gestion de la bibliothèque municipale',
            books: bookService.getBooks(),
            added: false,
            error: error.message
        });
    }
}

module.exports = {
    showHome,
    showBook,
    createBook
};