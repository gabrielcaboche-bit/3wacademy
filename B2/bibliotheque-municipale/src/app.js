const path = require('path');
const express = require('express');
const morgan = require('morgan');
const bookRoutes = require('./routes/bookRoutes');
const viewRoutes = require('./routes/viewRoutes');
const errorHandler = require('./middlewares/errorHandler');

const app = express();

app.set('views', path.join(__dirname, '../views'));
app.set('view engine', 'pug');

app.use(morgan(':method :url :status :response-time ms'));
app.use(express.json());
app.use(express.urlencoded({
    extended: true
}));
app.use(express.static(path.join(__dirname, '../public')));

app.use('/books', bookRoutes);
app.use('/', viewRoutes);

app.use((req, res, next) => {
    const error = new Error('Page introuvable.');
    error.statusCode = 404;
    next(error);
});

app.use(errorHandler);

module.exports = app;