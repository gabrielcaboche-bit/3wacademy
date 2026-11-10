# Architecture MVC et modèles de données

## Le principe MVC

MVC sépare les responsabilités d’une application :

- **Model (modèle)** : représente les données et porte les opérations ou règles métier liées à ces données.
- **View (vue)** : présente l’information à l’utilisateur ; en SSR, elle est rendue par un template.
- **Controller (contrôleur)** : reçoit la demande, coordonne le traitement, appelle le modèle et choisit la réponse ou la vue.

Le modèle n’a pas à dépendre du contrôleur ou de la vue. Cette séparation rend le projet plus lisible, modifiable et testable. Dans une API, la vue peut être remplacée par une réponse JSON plutôt qu’un fichier HTML.

Une organisation possible, montrée dans le cours, sépare `routes`, `controllers`, `models`, `middlewares`, `config`, `utilities` et éventuellement `dto`. Les routes relient URL/méthodes et fonctions de contrôleur ; le contrôleur orchestre ; le modèle accède aux données.

## Modèles et persistance avec Sequelize

Sequelize est un ORM : il représente des tables par des modèles JavaScript et des lignes par des instances. Le cours prend PostgreSQL comme base.

Un modèle décrit les champs, les types, les contraintes et les options de table. Les modèles peuvent représenter, par exemple, `Course`, `User` et `File`. Les contrôleurs utilisent des opérations du modèle pour créer, chercher et modifier des enregistrements.

- Une contrainte `allowNull: false` impose une valeur ; `unique: true` rend un champ unique.
- `timestamps: true` ajoute `createdAt` et `updatedAt`.
- `findOne`, `findByPk`, `findAll`, `create`, `bulkCreate`, `count` et `destroy` sont des opérations usuelles ; elles sont asynchrones et doivent être attendues avec `await` ou gérées avec des promesses.
- Un ordre de résultat peut être défini par plusieurs champs, par exemple nombre de chapitres décroissant puis titre croissant.

### Relations

Une relation 1-à-N entre utilisateurs et cours place généralement la clé étrangère `userId` dans `courses` : un `User` peut avoir plusieurs `Course`, et chaque `Course` appartient à un `User`.

```js
Course.belongsTo(User, { foreignKey: 'userId', as: 'user' });
User.hasMany(Course, { foreignKey: 'userId', as: 'courses' });
```

Le contrôleur peut créer le cours avec `userId: req.user.id` après que le middleware d’authentification a identifié l’utilisateur. Un modèle `File` séparé permet à un cours d’avoir plusieurs fichiers et de conserver leur nom, chemin, type MIME et taille, sans stocker les octets du fichier dans la table.

### Transactions

`sequelize.transaction()` regroupe plusieurs écritures en une unité atomique : soit toutes réussissent, soit elles sont annulées en cas d’erreur. C’est utile, par exemple, lorsqu’un chargement initial crée un utilisateur puis ses cours liés.

## Réponses JSON et frontières de couche

Les contrôleurs peuvent renvoyer des réponses JSON standardisées. Le cours montre un enveloppement avec un indicateur de succès et les données, ou avec une erreur, afin que le frontend traite les réponses de façon prévisible.

La validation des données entrantes doit intervenir avant la persistance, à la frontière de la requête. Une contrainte de base reste utile pour protéger l’intégrité des données, mais ne remplace pas une validation qui produit des erreurs lisibles au niveau HTTP.

