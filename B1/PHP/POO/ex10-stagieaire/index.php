+<?php

require_once 'Stagiaire.php';
require_once 'Formation.php';

$stagiaire1 = new Stagiaire("Alice", [15, 18, 20]);
$stagiaire2 = new Stagiaire("Bob", [12, 14, 16]);
$stagiaire3 = new Stagiaire("Charlie", [10, 11, 9]);

$formation = new Formation("PHP POO", 5, [$stagiaire1, $stagiaire2, $stagiaire3]);

echo "Moyenne de la formation : " . $formation->calculerMoyenneFormation() . "<br>";
echo "L'index du stagiaire avec la meilleure moyenne : " . $formation->afficherIndexMax() . "<br>";
echo "Le nom du stagiaire avec la meilleure moyenne : " . $formation->afficherNomMax() . "<br>";
echo "La note minimale du stagiaire avec la meilleure moyenne : " . $formation->afficherMinMax() . "<br>";
echo "Moyenne de Bob : " . $formation->trouverMoyenneParNom("Bob") . "<br>";