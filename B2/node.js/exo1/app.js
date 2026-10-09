const fs = require('node:fs');
const path = require('node:path');

const usersFile = path.join(__dirname, 'data', 'users.json');

fs.readFile(usersFile, 'utf8', (error, contents) => {
  if (error) {
    console.error(`Impossible de lire le fichier users.json : ${error.message}`);
    return;
  }

  let users;
  try {
    users = JSON.parse(contents);
  } catch (parseError) {
    console.error(`Le fichier users.json contient un JSON invalide : ${parseError.message}`);
    return;
  }

  if (!Array.isArray(users)) {
    console.error('Le contenu de users.json doit être un tableau d’utilisateurs.');
    return;
  }

  console.log('Noms des utilisateurs :');
  for (const user of users) {
    if (user && typeof user.name === 'string' && typeof user.age === 'number') {
      console.log(user.name);
      console.log(`Âge : ${user.age}`);
    } else {
      console.error('Un utilisateur ne possède pas de nom ou d\'âge valide.');
    }
  }
});
