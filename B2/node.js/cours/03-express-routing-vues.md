# Express, routage, vues et middlewares

## Express dans une application Node.js

Avec le module `http`, le développeur écrit lui-même la fonction qui reçoit une requête et produit sa réponse. Express fournit une structure autour de cette fonction : il reçoit la requête et la fait passer dans une pile ordonnée de couches (« layers »). Une couche peut examiner ou modifier `req`/`res`, répondre, ou transférer le contrôle à la suite.

```js
const express = require('express');
const app = express();

app.get('/', (req, res) => res.send('Bonjour'));
app.listen(3000);
```

Installer une dépendance et un outil de relance automatique se fait avec npm ; `nodemon` surveille les fichiers et redémarre le serveur pendant le développement.

## Routes et méthodes HTTP

Une route associe une méthode HTTP et un chemin à un traitement. Les verbes usuels expriment l’intention :

- `GET` : lire une ressource.
- `POST` : créer ou déclencher un traitement.
- `PUT` / `PATCH` : modifier une ressource.
- `DELETE` : supprimer une ressource.

Une réponse Express peut être du texte ou du HTML avec `res.send`, du JSON avec `res.json`, une redirection avec `res.redirect`, ou un statut seul avec `res.sendStatus`. On peut chaîner un statut et une réponse, par exemple `res.status(201).json(data)`.

Les routes sont examinées dans l’ordre où elles sont déclarées. Une route qui répond termine normalement le traitement ; une route ou un middleware qui appelle `next()` passe au suivant. Il faut placer les routes spécifiques comme `/courses/new` avant une route générique `/courses/:id`, sinon le segment `new` peut être pris pour un identifiant.

### Paramètres, query strings et chemins

Un paramètre de route commence par `:` et devient une propriété de `req.params` : `/users/:id` capture par exemple `/users/42` dans `req.params.id`. Plusieurs paramètres sont possibles (`/books/:bookId/chapters/:chapterId`). Les paramètres représentent généralement une ressource précise.

Les données placées après `?` dans une URL sont accessibles par `req.query` ; le corps d’une requête est accessible par `req.body` après installation du parseur adapté.

Le cours montre également les chemins facultatifs, jokers et motifs, ainsi que `app.all()` pour un traitement commun à toutes les méthodes d’un chemin. La syntaxe précise des motifs et paramètres facultatifs dépend de la version d’Express utilisée : consulter la documentation correspondant au projet.

`app.route('/article')` permet de chaîner les handlers de plusieurs méthodes sur le même chemin. `express.Router()` crée un routeur séparé, qui se monte dans l’application avec `app.use('/article', articleRouter)` ; ses routes locales (`'/'`, `'/:id'`) héritent alors du préfixe.

### API REST

Une API REST expose des ressources identifiées par des URL et les manipule avec les méthodes HTTP. Les appels sont conçus comme stateless : le contexte nécessaire à une requête est transmis avec celle-ci. En pratique, une API claire utilise des noms de ressources (`/users`, `/articles/15`), des verbes adaptés, des statuts cohérents (200, 201, 400, 401, 403, 404, 500), un format de réponse régulier et, lorsque nécessaire, filtres, tri, pagination et versionnement (`/api/v1`). HTTPS, authentification, limitation de débit et documentation d’API font partie des sujets de production.

## Middlewares Express

Un middleware est une fonction appelée pendant le traitement d’une requête. Sa signature usuelle est `(req, res, next)` :

```js
function logger(req, res, next) {
  console.log(req.method, req.url);
  next();
}

app.use(logger);
```

Il peut lire ou enrichir la requête, ajouter des informations ou des méthodes à la réponse, envoyer une réponse pour arrêter la chaîne, ou appeler `next()` pour continuer. L’ordre d’enregistrement est essentiel. Un middleware qui ne répond pas et n’appelle pas `next()` laisse la requête bloquée.

On peut enregistrer un middleware globalement (`app.use(fn)`), le limiter à un préfixe (`app.use('/article', fn)`), appliquer une liste de middlewares à une route ou regrouper des middlewares dans un tableau.

### Corps de requête et ressources statiques

Les parseurs doivent être installés avant les routes qui lisent `req.body` :

```js
app.use(express.json());
app.use(express.urlencoded({ extended: true }));
```

- `express.json()` décode les corps `application/json`.
- `express.urlencoded()` décode les formulaires encodés en paires clé/valeur. L’option `extended` sélectionne l’interprétation simple ou imbriquée des données.
- Les formulaires HTML sans upload utilisent généralement `application/x-www-form-urlencoded`; les API envoient souvent `application/json`; les fichiers passent par `multipart/form-data`.

Pour distribuer CSS, images et autres fichiers destinés au public, `express.static(path.join(__dirname, 'public'))` mappe les URL vers le répertoire `public`. N’y placer que les ressources qui peuvent être publiques. Le middleware statique est enregistré avant les routes ou contrôles qui pourraient intercepter ces requêtes. Une route `res.sendFile()` par fichier est possible mais ne gère pas aussi naturellement l’ensemble du dossier.

`morgan` est un middleware de journalisation HTTP. Il affiche par exemple méthode, URL, statut, durée et taille de la réponse. Le format `dev` est concis pour le développement ; d’autres formats incluent plus de détails.

## Templates et rendu côté serveur

Un moteur de templates transforme une vue et des données en HTML final côté serveur. Le navigateur reçoit le HTML rendu. Cela permet d’afficher des vues dynamiques selon le contexte (par exemple connecté ou non), d’injecter des données et de réutiliser des morceaux de vue.

Express configure le dossier des vues et le moteur avec `app.set('views', chemin)` et `app.set('view engine', 'pug')`. Une route peut appeler `res.render('index', { name: 'Alice' })`.

Le cours présente Pug :

- L’indentation représente l’imbrication des balises.
- Les attributs suivent la balise entre parenthèses.
- `#{name}` insère une valeur dans le texte ; `if/else` conditionne le rendu ; `each user in users` parcourt un tableau.
- Les classes peuvent s’écrire sous la forme `.card.active`, les identifiants sous la forme `#main`, et les deux peuvent être combinés.
- `include` insère un partial, par exemple un en-tête ou pied de page commun.
- `extends` et `block` permettent à des vues de réutiliser une mise en page principale.

Un moteur maison peut être compris comme l’enchaînement lecture de fichier, remplacement d’un marqueur, puis réponse HTML. En pratique, utiliser un moteur établi évite de réimplémenter les fonctionnalités de rendu.

Express peut servir des pages HTML rendues en SSR ou uniquement une API REST en JSON pour un frontend séparé (React, Angular, Vue…). Ce sont deux façons différentes d’utiliser le backend.

