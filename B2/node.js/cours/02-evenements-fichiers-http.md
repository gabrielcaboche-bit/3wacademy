# Événements, fichiers, chemins et HTTP

## Événements et libuv

Un événement signale quelque chose qui vient de se produire et auquel le programme peut réagir.

- Les **événements système** proviennent de l’OS : arrivée réseau, opération de fichier, résolution DNS, timer ou signal.
- Les **événements personnalisés** sont émis par l’application, en JavaScript.

libuv est une bibliothèque C multiplateforme qui masque les différences entre systèmes d’exploitation. Elle coordonne les I/O asynchrones, timers, callbacks et certaines tâches via un pool de threads. Lorsqu’une opération déléguée se termine, libuv place le callback correspondant dans la file appropriée ; la boucle d’événements le fait exécuter par V8 au moment opportun.

Les principales phases de l’event loop abordées au cours sont : timers (`setTimeout`, `setInterval`), callbacks d’I/O, phases internes, poll (attente et traitement des événements I/O), check (`setImmediate`) et callbacks de fermeture.

Pour créer des événements applicatifs, le module natif `events` fournit `EventEmitter` :

```js
const { EventEmitter } = require('node:events');
const bus = new EventEmitter();

bus.on('file:read', (filename) => {
  console.log(`Fichier lu : ${filename}`);
});

bus.emit('file:read', 'notes.txt');
```

`on(event, listener)` enregistre un listener ; `emit(event, ...args)` déclenche l’événement et transmet ses arguments. Un même événement peut avoir plusieurs listeners.

## Système de fichiers : `fs`

Le module natif `fs` donne accès aux fichiers et dossiers. Les API asynchrones évitent de bloquer le thread JavaScript pendant les opérations disque. Le cours présente l’API à callbacks, avec des appels tels que `open`, `read`, `write` et `close`.

### Descripteurs et modes d’ouverture

`fs.open(path, flags[, mode], callback)` ouvre une ressource et fournit un descripteur (`fd`). Le descripteur est un identifiant système réutilisé pour lire, écrire ou fermer cette ressource. Les valeurs standards `0`, `1` et `2` correspondent à stdin, stdout et stderr.

Principaux flags :

| Flag | Effet |
| --- | --- |
| `r` | Lecture ; échoue si le fichier n’existe pas. |
| `r+` | Lecture et écriture ; échoue si le fichier n’existe pas. |
| `w` | Écriture ; crée le fichier ou tronque celui qui existe. |
| `w+` | Lecture et écriture ; crée ou tronque. |
| `a` | Ajout à la fin ; crée au besoin. |
| `a+` | Lecture et ajout ; crée au besoin. |
| `x` | Variante exclusive : échoue si le fichier existe déjà. |

Les callbacks reçoivent l’erreur en premier. `fs.write` travaille avec un buffer et renvoie notamment `bytesWritten`; `fs.read` remplit un buffer et renvoie `bytesRead`. Pour les grands fichiers, lire par morceaux (« chunks ») évite de charger tout le contenu en mémoire. Il faut fermer le descripteur avec `fs.close` après usage.

Dans du code courant, on peut souvent préférer les API plus haut niveau (`fs.readFile`, `fs.writeFile`) ou les promesses de `node:fs/promises`, tout en conservant les mêmes principes de gestion asynchrone et d’erreurs.

### Dossiers et métadonnées

- `fs.mkdir(path, { recursive: true })` crée une arborescence de dossiers.
- `fs.readdir(path)` liste les noms ; `{ withFileTypes: true }` fournit des `Dirent` pour distinguer fichiers et dossiers.
- `fs.rm(path, { recursive: true, force: true })` supprime un dossier et son contenu. `rmdir` est l’ancienne API présentée comme dépréciée.
- `fs.rename(source, destination)` renomme ou déplace.
- `fs.opendir(path)` permet d’itérer sur le contenu d’un répertoire.
- `fs.stat`, `fs.lstat` et `fs.fstat` donnent des métadonnées, dont la taille, les dates, `isFile()` et `isDirectory()`.
- `fs.copyFile(source, destination)` copie un fichier ; `COPYFILE_EXCL` empêche d’écraser une destination existante.

Un `Buffer` représente des octets bruts, utiles pour les données binaires ou les I/O. Convertir une portion en texte se fait par exemple avec `buffer.toString('utf8', début, fin)`.

## Manipulation portable des chemins : `path`

Le module natif `path` évite de construire des chemins en supposant les séparateurs de Windows ou d’Unix :

- `path.join(...segments)` assemble des segments.
- `path.resolve(...segments)` produit un chemin absolu.
- `path.basename(p)` renvoie le nom final ; `dirname(p)` le dossier parent ; `extname(p)` l’extension.
- `path.parse(p)` découpe un chemin en parties ; `path.format(obj)` reconstruit le chemin.
- `path.normalize(p)` corrige les séparateurs redondants et segments `..`.

Pour viser un fichier du projet, utiliser un chemin calculé à partir de `__dirname`, par exemple `path.join(__dirname, 'data', 'notes.txt')`.

## Réseau et serveur HTTP natif

Une requête réseau circule entre une adresse IP et un port au moyen d’un socket. TCP transporte les données en paquets ; HTTP définit la structure et le sens de la requête et de la réponse.

Le module `http` permet de créer un serveur minimal :

```js
const http = require('node:http');

const server = http.createServer((req, res) => {
  res.writeHead(200, { 'Content-Type': 'text/plain; charset=utf-8' });
  res.end('Bonjour');
});

server.listen(3000);
```

- `http.createServer(handler)` crée un objet serveur. Il est basé sur `EventEmitter` ; le callback fourni traite l’événement `request`, ou on peut utiliser `server.on('request', handler)`.
- `req` représente la requête entrante ; on y trouve notamment `req.method`, `req.url` et `req.headers`.
- `res` représente la réponse sortante. `writeHead(status, headers)` définit le statut et les en-têtes ; `end(body)` termine la réponse.
- `server.listen(port)` commence l’écoute. Le port identifie le programme sur la machine ; `3000` est courant en développement, `80` pour HTTP et `443` pour HTTPS.
- Le serveur peut écouter `close`, `connection` et `error`.

Les réponses peuvent contenir du texte (`text/plain`), du HTML (`text/html`), du JSON (`application/json`) ou un fichier. Il faut renvoyer des statuts cohérents, par exemple 404 quand une route n’existe pas et 500 en cas d’erreur serveur.

Sans framework, on peut router en inspectant `req.url` et `req.method`, puis en choisissant une réponse. Cette approche montre les mécanismes de base, mais devient vite difficile à maintenir ; Express apporte une gestion des routes et des middlewares plus structurée.

