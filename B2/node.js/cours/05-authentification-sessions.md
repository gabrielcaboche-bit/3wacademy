# Authentification, mots de passe, cookies et sessions

## Hashage et vérification des mots de passe

Un mot de passe ne doit pas être stocké en clair. Le cours utilise `bcrypt` pour calculer un hash avant enregistrement, puis comparer plus tard le mot de passe saisi avec le hash conservé.

Sequelize permet d’automatiser cette étape avec des hooks de cycle de vie, par exemple `beforeCreate` et `beforeUpdate`. Le hook de mise à jour doit vérifier `user.changed('password')` : rehacher un hash existant lors d’une modification d’un autre champ rendrait le mot de passe inutilisable.

```js
const salt = await bcrypt.genSalt(10);
user.password = await bcrypt.hash(user.password, salt);
```

La vérification se fait avec `bcrypt.compare(motDePasseSaisi, hashStocke)`. Le modèle peut exposer une méthode d’instance telle que `user.passwordMatches(candidate)` ; une méthode statique comme `User.authenticate(email, password)` peut retrouver l’utilisateur, puis appeler cette méthode.

Ne pas renvoyer le champ `password` dans une réponse API. Le cours illustre une méthode de sérialisation qui copie les valeurs du modèle puis supprime `password`, `createdAt` et `updatedAt` avant exposition. En production, mieux vaut également choisir explicitement les attributs exposés dans chaque requête/réponse.

## Authentification et middleware

L’authentification répond à « qui est cet utilisateur ? » ; l’autorisation répond à « a-t-il le droit d’effectuer cette action ? ». Les routes protégées peuvent recevoir un middleware avant le contrôleur :

1. Lire l’en-tête `Authorization`.
2. Vérifier le schéma et le jeton.
3. Identifier l’utilisateur et vérifier ses identifiants.
4. En cas de succès, placer le contexte utilisateur dans `req.user` (ou `req.auth`).
5. Appeler `next()` pour continuer.
6. En cas d’absence ou d’invalidité, renvoyer `401`; si l’identité est valide mais que le droit manque, renvoyer `403`.

Les exemples du cours construisent temporairement un jeton `Basic` par encodage Base64 de `email:password`. Base64 n’est pas du chiffrement et ne protège pas le secret : cette forme pédagogique ne doit pas être traitée comme un mécanisme sûr de transport des mots de passe. Utiliser HTTPS et une stratégie d’authentification adaptée au projet ; ne jamais considérer Base64 comme une protection cryptographique.

Les exemples plus avancés présentent un JWT signé, placé dans un cookie, ou une session persistée côté serveur. Le middleware centralisé applique la même logique de vérification aux routes sans répéter l’authentification dans chaque contrôleur. Le contrôleur peut alors associer la ressource créée à `req.user.id`.

## Cookies et sessions

HTTP est sans état : chaque requête est indépendante. Un **cookie** est une petite donnée stockée par le navigateur puis renvoyée automatiquement au serveur pour le domaine concerné. Il peut contenir une préférence ou un identifiant ; sa taille est limitée (environ 4 Ko par cookie) et ses attributs déterminent sa portée et sa sécurité.

Une **session** conserve l’état côté serveur. Le navigateur reçoit seulement un identifiant de session, souvent dans un cookie ; le serveur retrouve avec cet identifiant les données associées à l’utilisateur. Le cookie est alors la clé, la session la valeur.

| | Cookie seul | Session serveur |
| --- | --- | --- |
| Emplacement des données | Navigateur | Serveur (mémoire ou store partagé) |
| Avantage | Peu de mémoire serveur ; utile pour préférences légères | Données et état riches gardés côté serveur ; révocation immédiate possible |
| Limite | Taille limitée ; données côté client manipulables si mal protégées | Nécessite un store, expiration/nettoyage et coordination entre instances |

Attributs importants : `HttpOnly` empêche le JavaScript navigateur de lire le cookie ; `Secure` impose HTTPS ; `SameSite` aide à limiter certaines attaques CSRF ; `Path`, `Domain`, `Expires` et `Max-Age` règlent sa portée et sa durée.

### Deux modèles d’authentification vus au cours

**JWT dans cookie (stateless)** : après vérification du mot de passe hashé, le serveur signe un JWT (par exemple HS256) avec une durée de vie et le place dans un cookie `HttpOnly`, `Secure` en production et assorti de `SameSite`. Le middleware extrait le jeton, vérifie sa signature et son expiration, puis place une identité minimale dans `req.auth`. Garder la clé secrète hors du code et du dépôt. Les jetons courts peuvent être associés à un mécanisme de refresh ; la révocation anticipée demande une stratégie côté serveur (version, liste de révocation, etc.).

**Session stockée côté serveur (stateful)** : `express-session` crée un identifiant opaque (`sid`) et le store persiste l’état. Un store Sequelize/PostgreSQL est présenté via `connect-session-sequelize`. À la connexion, le serveur place par exemple `userId` dans `req.session`; une route protégée vérifie sa présence. À la déconnexion, détruire la session et effacer le cookie. Dans un système distribué, toutes les instances doivent partager le même store.

Bonnes pratiques transverses du cours : renouveler l’identifiant de session à la connexion pour éviter la fixation de session ; expirer et nettoyer les sessions ; utiliser TLS et `Secure` en production ; choisir `SameSite` selon le cas d’usage et ajouter une vraie protection CSRF si nécessaire ; ne placer dans les réponses que les informations minimales utiles.

