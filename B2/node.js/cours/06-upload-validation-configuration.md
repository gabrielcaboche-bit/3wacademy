# Upload, validation, erreurs et configuration

## Middlewares personnalisés et gestion d’erreurs

Un middleware peut ajouter des méthodes à `res` pour standardiser toutes les réponses. Le cours illustre `res.jsonSuccess(data, statusCode)` et `res.jsonError(message, statusCode)` afin que les contrôleurs produisent des objets cohérents et faciles à consommer.

Les erreurs non prévues doivent être transmises à un middleware de gestion centralisé, au lieu de laisser le serveur s’arrêter. Le middleware d’erreur Express a quatre paramètres et se place après les routes et middlewares ordinaires :

```js
function errorHandler(err, req, res, next) {
  const status = err.status || 500;
  res.status(status).json({ success: false, error: err.message });
}

app.use(errorHandler); // après les routes
```

Un contrôleur asynchrone peut transmettre une erreur avec `next(error)`. Le middleware final la journalise et renvoie une erreur normalisée. Ne pas exposer au client les détails internes ou les traces sensibles. Le middleware d’erreur est distinct d’un middleware ordinaire et son ordre est important.

## Upload de fichiers avec Multer

Un formulaire qui envoie un fichier utilise `multipart/form-data`. Multer traite ce format comme middleware avant le contrôleur. Le cours rappelle que la base de données conserve les métadonnées et le chemin du fichier, alors que le contenu réel est écrit sur le disque.

Flux logique :

1. Modéliser les métadonnées du fichier (`filename`, `path`, `mimetype`, `size`) dans une table `File`.
2. Relier `Course.hasMany(File)` et `File.belongsTo(Course)`.
3. Configurer Multer avec `diskStorage` pour choisir le dossier et le nom du fichier.
4. Placer les fichiers accessibles au public dans un dossier dédié, par exemple `public/uploads`, puis configurer la route `POST /courses/:id/upload`.
5. Le contrôleur vérifie le cours cible, enregistre les métadonnées et renvoie le résultat.

`destination(req, file, cb)` définit le dossier ; `filename(req, file, cb)` définit le nom enregistré. Une UUID ajoutée à un nom nettoyé réduit les collisions. Le cours utilise `path.basename`, remplace les espaces et crée le dossier si nécessaire. Il montre également une limite de taille de fichier.

```js
const upload = multer({
  storage: multer.diskStorage({
    destination: (req, file, cb) => cb(null, uploadDir),
    filename: (req, file, cb) => cb(null, `${uuid()}-${path.basename(file.originalname)}`)
  }),
  limits: { fileSize: 10 * 1024 * 1024 }
}).single('file');
```

Les fichiers statiques dans `public/` sont accessibles publiquement : ne jamais y placer de contenu sensible. En complément des notions montrées en cours, un upload réel doit aussi vérifier les types et contenus autorisés, limiter taille et fréquence, et éviter de faire confiance au seul nom ou MIME fourni par le client.

## Validation des données

La validation vérifie le format, le type, les contraintes et les règles métier des données reçues avant leur traitement ou leur enregistrement. Elle protège la cohérence de l’application et permet des erreurs compréhensibles. Exemples : email valide, titre non vide, âge positif, mot de passe d’une longueur et d’une complexité minimales.

La validation devrait être faite tôt, au niveau de la requête, dans un middleware avant le contrôleur et la persistance. Le modèle et la base gardent aussi leurs contraintes d’intégrité ; la validation HTTP ne les remplace pas.

### `express-validator`

`express-validator` construit des règles déclaratives sur `body`, `params` ou `query`, puis `validationResult(req)` récupère les erreurs :

```js
body('email').trim().isEmail().withMessage('Email invalide');
body('password').isLength({ min: 8 });
```

Pour garder les routes lisibles, le cours recommande de déplacer les règles dans des fichiers `validators/` et d’utiliser un middleware générique qui exécute les règles, vérifie `validationResult`, renvoie `400` si elles échouent, sinon appelle `next()`.

### Zod

Zod valide les données à partir d’un schéma qui décrit la forme attendue. Il fonctionne en JavaScript ou TypeScript et peut contrôler `req.body`, `req.params`, `req.query` ainsi que des données locales.

```js
const { z } = require('zod');

const courseSchema = z.object({
  title: z.string().min(10),
  nbChapters: z.number().int(),
  done: z.boolean().optional().default(false)
});

const result = courseSchema.safeParse(req.body);
if (!result.success) {
  // transformer result.error.issues en erreurs API lisibles, puis répondre 400
}
const validData = result.data;
```

`safeParse` fournit un résultat discriminé, et `result.data` contient les données validées (avec les valeurs par défaut). Un helper partagé peut convertir les issues en paires chemin/message et éviter de répéter le formatage. Centraliser les schémas offre une source de vérité unique et améliore la maintenabilité.

## Variables d’environnement et `dotenv`

Une application passe par plusieurs environnements (développement, test, préproduction, production). Le port, l’URL de base de données, les clés API et autres paramètres ne doivent pas être codés en dur : le programme lit des variables d’environnement dans `process.env`.

Un fichier `.env` à la racine peut centraliser les valeurs locales ; `dotenv` les charge au démarrage :

```js
require('dotenv').config();
const port = process.env.PORT || 3000;
```

Bonnes pratiques :

- ne jamais committer `.env` ni des secrets ; l’ajouter à `.gitignore` ;
- fournir un `.env.example` sans valeurs secrètes pour documenter les variables nécessaires ;
- garder la même base de code entre environnements et ne changer que la configuration ;
- en production, utiliser un gestionnaire de secrets ou les variables configurées par l’hébergeur.

