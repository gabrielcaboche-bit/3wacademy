<?php
require_once "Classes/Utilisateurs.php";
require_once "Classes/Etudiant.php";
require_once "Classes/Formateur.php";
require_once "Classes/Administrateur.php";

$etudiant = new Etudiant("Alice", "Alice@gmail.com");
$formateur = new Formateur("Bob", "Bob@gmail.com");
$admin = new Administrateur("Charlie", "Charlie@gmail.com");

echo $etudiant->getInfos() . " - " . $formateur->getInfos() . " - " . $admin->getInfos() . "<br>";
echo $etudiant->getRole() . " - " . $formateur->getRole() . " - " . $admin->getRole() . "<br>";
echo $etudiant->etudier() . " - " . $formateur->enseigner() . " - " . $admin->gererPlatforme() . "<br>";

$users = [$etudiant, $formateur, $admin];
foreach($users as $user) {
    echo $user->getRole() . "<br>";
}