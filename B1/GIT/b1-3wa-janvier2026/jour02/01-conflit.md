# un conflit 

- sur votre repository local un fichier index.html 
- ligne 10 => <p class="toto">bonjour</p>


- sur le repository distant le même fichier index.html
- sur la même ligne 10 => <p class="titi">bonjour</p>


- vous voulez importer le fichier distant => `git pull`
- git ne va pas savoir quel ligne il doit prendre ??? 
- <p class="toto">bonjour</p>
- <p class="titi">bonjour</p>


```txt
Auto-merging fil-rouge/index.html
CONFLICT (content): Merge conflict in fil-rouge/index.html
Automatic merge failed; fix conflicts and then commit the result.
```

Choisir laquelle des versions git doit être conservée / gardée :

- current Change (dans le repo local)
- incoming change (depuis le repo distant)
- ou les deux ou autre chose ??? 


la valider en local 

```sh
git add .
git commit -m "fix(jour02) gestion des conflits"
```