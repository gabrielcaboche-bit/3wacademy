function errorHandler(error, req, res, next) {
    if (res.headersSent) {
        return next(error);
    }

    const statusCode = error.statusCode || 500;
    const message = statusCode === 500 ? 'Une erreur interne est survenue.' : error.message;

    if (req.path === '/books') {
        return res.status(statusCode).json({
            error: message
        });
    }

    return res.status(statusCode).render('index', {
        title: 'Gestion de la bibliothèque municipale',
        books: [],
        added: false,
        error: message
    });
}

module.exports = errorHandler;