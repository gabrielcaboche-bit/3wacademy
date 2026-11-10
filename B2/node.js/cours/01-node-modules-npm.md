# Node.js, modules et npm

## Node.js et son environnement

Node.js est un environnement d’exécution qui permet d’exécuter JavaScript hors du navigateur. Ce n’est ni un langage ni un framework.

- Le moteur **V8** exécute le JavaScript et le traduit en instructions machine. Il est utilisé par Chrome et est écrit en C++.
- **libuv** complète V8 en assurant les entrées-sorties, les timers, la boucle d’événements et certaines tâches déléguées au système d’exploitation.
- Node.js peut interagir avec le système de fichiers, le réseau et les bases de données. Les API propres au navigateur, comme `window`, `document` ou `localStorage`, n’y existent pas.
- Le serveur reçoit des requêtes (souvent HTTP), exécute le code et renvoie des réponses.

V8 exécute le JavaScript sur un thread principal, une instruction à la fois. L’architecture Node.js permet toutefois de ne pas immobiliser ce thread pendant des entrées-sorties : libuv délègue le travail au système ou à son pool de threads, puis remet les callbacks prêts à exécuter dans les files d’événements. « Asynchrone » et « non bloquant » décrivent donc la gestion des opérations d’attente ; ils ne signifient pas que le code JavaScript lui-même s’exécute simultanément sur plusieurs threads.

## Modules CommonJS

Un module est un bloc de code réutilisable, isolé du reste de l’application. En CommonJS, un fichier exporte son interface avec `module.exports` et un autre le charge avec `require`.

```js
// math.js
const double = (n) => n * 2;
module.exports = { double };

// app.js
const { double } = require('./math');
console.log(double(4));
```

- `module.exports` est la valeur réellement renvoyée par `require()`.
- `exports` est au départ un raccourci vers `module.exports`. Affecter un nouvel objet à `exports` seul ne remplace pas `module.exports`.
- Pour exporter plusieurs valeurs, on peut assigner un objet à `module.exports`, ou lui ajouter des propriétés.
- Un chemin local commence par `./` ou `../`. Sans chemin, Node recherche d’abord les modules natifs, puis les paquets installés dans `node_modules`.
- Un dossier importé peut exposer son `index.js` ou le point d’entrée défini dans son `package.json`.
- Les modules natifs peuvent aussi être importés avec le préfixe explicite `node:` (par exemple `require('node:fs')`).

Node met en cache le résultat du premier chargement d’un module. Les appels `require()` suivants renvoient la même référence : modifier un objet exporté est donc visible depuis les autres fichiers qui l’importent. Si un module exporte une fonction qui fabrique et renvoie un objet, chaque appel de cette fonction peut créer une instance séparée.

Node fournit des variables globales ou disponibles dans les modules, notamment `console`, `process`, `setTimeout`, `__dirname` et `__filename`. Les modules natifs, eux, s’importent : `fs`, `path`, `http`, `events`, `util`, etc.

## Initialiser et organiser un projet npm

`npm` est à la fois l’outil de ligne de commande et le registre public de paquets JavaScript. Il permet d’installer, mettre à jour et supprimer des dépendances, de déclarer des scripts et de publier des paquets.

```sh
npm init -y
npm install express
npm install --save-dev nodemon
npm update express
npm uninstall express
```

`npm init` crée `package.json`, qui décrit le projet, son point d’entrée, ses scripts et ses dépendances. `npm install` ajoute le paquet à `dependencies` par défaut ; `--save-dev` le place dans `devDependencies`.

- **`dependencies`** : paquets nécessaires au fonctionnement de l’application déployée.
- **`devDependencies`** : outils utiles pour développer, par exemple `nodemon` ou un outil de tests.
- **`node_modules/`** contient les dépendances installées ; le dépôt versionne plutôt `package.json` et `package-lock.json`.
- `package-lock.json` conserve l’arbre de versions résolu pour rendre les installations reproductibles.
- On peut définir des commandes dans `scripts`. `npm start` lance le script `start`; les autres scripts se lancent généralement avec `npm run nom`.

```json
{
  "scripts": {
    "start": "node app.js",
    "dev": "nodemon app.js"
  }
}
```

`nodemon` relance le processus Node lorsque les fichiers surveillés changent. Il est normalement réservé au développement.

## Versions sémantiques

Une version de paquet suit souvent le schéma `MAJOR.MINOR.PATCH` :

- **PATCH** : correction compatible, généralement sans changement d’interface.
- **MINOR** : ajout de fonctionnalités compatible.
- **MAJOR** : évolution susceptible de casser la compatibilité et d’exiger des adaptations.

Les préfixes de version dans `package.json` influencent les mises à jour permises ; il faut vérifier les changements majeurs avant de faire évoluer une dépendance.

