const Notifier = require('./notifier');

const notifier = new Notifier();

notifier.on('NOTIFY', (message) => {
  console.log(`Notification reçue : ${message}`);
});

notifier.on('ERROR', (error) => {
  console.error(`Erreur : ${error.message}`);
});

notifier.sendNotification('Votre commande a été expédiée.');
notifier.sendNotification('Un nouveau message vous attend.');
notifier.sendNotification(''); // Déclenche l’évènement ERROR.
