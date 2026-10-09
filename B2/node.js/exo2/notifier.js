const { EventEmitter } = require('node:events');

class Notifier extends EventEmitter {
  sendNotification(message) {
    if (typeof message !== 'string' || message.trim() === '') {
      this.emit('ERROR', new Error('Le message de notification ne peut pas être vide.'));
      return;
    }

    this.emit('NOTIFY', message);
  }
}

module.exports = Notifier;
