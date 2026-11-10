const express = require('express');
const viewController = require('../controllers/viewController');

const router = express.Router();

router.get('/', viewController.showHome);
router.post('/add-book', viewController.createBook);
router.get('/books/view/:id', viewController.showBook);

module.exports = router;