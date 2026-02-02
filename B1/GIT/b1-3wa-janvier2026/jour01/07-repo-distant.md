# je veux partager mon code sur un dépôt distant 

- prendre mon code est le mettre sur github 
- je dois me connecter github (avec un profil)
- créer un répository sur github (le nom du projet)
- copier les commandes suivantes 

```sh
# associer le repository local avec le resposity distant 
git remote add origin <adresse de votre repository>


# prendre l'ensemble des commits enregistrés dans votre ordinateur
# et les envoyer (push) sur le repository distant 
git push -u origin main
```
 
---

# cas pratique

le fichier index.html ajouter à la fin du fichier dans la page footer 
un formulaire avec 2 champs 
    un champ input de type email qui permet à l'utilisateur de s'inscrire à newsletter
    un button pour soumettre le formulaire

une fois que code est saisie vous allez faire 

git add .
git commit -m "feat(home) formulaire newsletter"
git push

regarder sur le github si le commit a bien été ajouté  

git branch -M main 


---

# git remote 

- permet de faire une liaison entre le REPO local et le REPO distant 

```sh
git remote add origin <adresse_internet>
```

connaitre l'adresse de mon dépôt pour le push et pour le pull 

```sh
git remote --verbose
git remote -v
```

- push LOCAL -> DISTANT
- pull DISTANT -> LOCAL

# je veux changer l'adresse du dépôt distant 

- solution 1 supprimer l'adresse et refaire un git remote add


```sh
# rm => remove (supprimer) supprimer l'adresse de liaison sur le dépôt local
git remote rm origin
# ajouter la nouvelle adresse
git remote add origin <nouvelle_adresse_internet>
```

- solution 2 remplacer l'ancienne adresse par la nouvelle

```sh
git remote set-url origin <nouvelle_adresse>
```
