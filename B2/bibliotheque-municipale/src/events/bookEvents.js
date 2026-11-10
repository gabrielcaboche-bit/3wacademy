const EventEmitter = require('events');

const bookEvents = new EventEmitter();

bookEvents.on('book:added', (book) => {
  console.log(`[EVENT] Livre ajouté : "${book.titre}" (ID : ${book.id})`);
});

bookEvents.on('book:deleted', (book) => {
  console.log(`[EVENT] Livre supprimé : "${book.titre}" (ID : ${book.id})`);
});

module.exports = bookEvents;