# comment travailler à plusieurs avec git ??

git pull

# le concept de Branch

-> schéma 

dans git vous avez la branch principale => main (avant master)

cette branch contient la version principal de votre projet 

vous pouvez à tout moment créer "une branch" qui va partir de la branch principale et qui va constituer comme un "univers parallèle"

en général on va créer une branch par nouvelle fonctionnalité

# sur quelle branch je suis / lister toutes les branch disponibles ??

```sh
git branch

# * main
# je n'ai qu'une seule branch ET je suis dessus 
# avant de créer une branch il est conseillé de git add . et commit 
```

# créer une branch  qui s'appelle `feature_1` et on s'est positionné dessus

```sh
# créer la branch
git branch feature_1
# lister les branch disponibles 
git branch
##   feature_1
## * main

# se positionner sur la branch feature_1
git checkout feature_1
git switch feature_1
# Switched to branch 'feature_1'
# vérifier que vous êtes sur la branch 
git branch
```

# etant donné que l'on est désormais sur cette branch 

- toute modification réalisée dans cette branch va être disponible que sur cette branch
- 
- si vous saisieez la commande suivant : `git checkout main` => tout le code écrit et commit dans la branch feature_1 va disparaitre

# la fonction la plus importante 

- explique pourquoi git a été créé => créer des branch
- svn => ancêtre de git => <https://tortoisesvn.net/>
- si vous vouliez changer de branch (avec beaucoup de modification)
- vous pouviez attendre 1 et 2 heures 

# fusionner la branch feature_1 avec la branch main 

1er solution

```sh
git add .
git commit -m "fonctionnalité opérationnelle"
# se positionner sur la branch principale
git checkout main
# fusionner la branch principale avec la branch feature_1
git merge feature_1
# si il n'y a de conflit 
# supprimer la branch feature_1
git branch -d feature_1
```

# je push la branch principale 

- au maximum une branch doit avoir une durée de vie de 1 semaine 
- potentiellement créer des conflits avec la branch principale
- 1 branch par développeur 
- ne pas hésiter à supprimer la branch quand elle est fusionnée avec la branch main 


# cas pratique 


créer une nouvelle branch qui s'appelle exo1
se positionner dans la branch exo1

modifier index.html ajouter le composant 
- un diaporama dans le fichier index.html <https://getbootstrap.com/docs/5.3/components/carousel/>
- tu valides avec git add . git commit 
- se positionner dans la branch principale
- fusionner la branch exo1 avec la branch principale
- supprimer la branch exo1