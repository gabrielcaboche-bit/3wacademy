# Les mots de git et github 

# REPOSITORY (dépôt)

- le versionning réalisé par git va être stocké dans un dossier SPECIAL 
- REPOSITORY (dossier technique qui contient les différentes versions de votre code )
- REPO / dépôt 
- ressemble à une base de données 
- Dépôt LOCAL (celui qui est enregistré dans votre ordinateur)
- Dépôt DISTANT (celui qui va être enregistré sur github)


# COMMIT 

- VERSION DE VOTRE PROJET 
- VERSION INCREMENTALE (VERSION QUI NE VA STOCKER QUE LES NOUVEAUTES )
- `git commit` 
- chaque commit à un nom que vous allez lui donner ET un clé primaire (base de données) hash 
- 1 COMMIT par fonctionnalité

# FAIRE COMMUNIQUER REPO LOCAL avec REPO DISTANT 

- commande envoyer du code du local -> distant : `git push`
- commande qui permet récupérer du code distant -> local : `git pull` 
- 
- 1 Par jour (fin de journée / début de journée)

- HASH => fonction qui permet de tranformer un texte en une chaine de caractère (hash / empreinte)
- MD5() fonction de hashage 
- google => MD5 generator => https://www.md5hashgenerator.com/
- 
- bonjour => f02368945726d5fc2a14eb576f7276c0
- a       => 0cc175b9c0f1b6a831c399e269772661

# BRANCH 

- créer des mondes parallèles 
- vous avez une nouvelle fonctionnalité qui vous souhaitez créer MAIS vous ne voulez pas que ce code IMPACTE le travail EXISTANT 
- git permet de créer un BRANCH => monde parallèle à votre projet (QUI N IMPACTE PAS LE PROJET EXISTANT)
- par défaut vous versionnez sur la branch principal du projet qui s'appelle la branch `main`
