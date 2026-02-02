# Rappel 

Repo distant et local 


- Repo distant => sur github.com
- Repo local => sur la machine 

```sh
git init
# créer un dossier .git à la racine du projet 
# stocker les versions de notre projet
```

# COMMIT 

- version 

```sh
git add . # sélectionner tous les fichiers (même les nouveaux) et les nouveautés (nouvelles lignes) dans des fichiers connus et valide les pour qu'ils soient COMMIT 
git commit -m "explication" # VRAIMENT enregistrer dans le dossier .git 
```

# suivi des commits

```sh
git status 
git log
gitk
```

# revenir dans le passer

```sh
# revenir dans le passé
git log --oneline
git checkout <id_commit>
# revenir maintenant
git checkout main
```

# PUSH 

```sh
# la première fois il faut paramètre le push
git branch -M main # il faut que la branch principale du projet s'appelle main
git remote add origin https://github.com/prenom_nom_profil/nom_projet
git push origin main # uniquement la première fois
                     # je veux que git push les versions actuelles vers le dépôt 
                     # https://github.com/prenom_nom_profil/nom_projet DANS sa branch main
```

# une fois que l'on télécharge un projet depuis git avec

modifier l'adresse du dépôt pour le push

```sh
git clone
git remote set-url origin https://github.com/prenom_nom_profil/nom_projet_2
```



