<?php
session_start();

include 'connexion.php';
// Vérifie si l'utilisateur est déjà connecté, si oui, l'envoie vers la page 'secret'
if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
    header("Location: secret.php");
    exit();
}

// Si on a bien une requête POST, on récupère les données identifiant et password.
if (!empty($_POST)) {
    $identifiant = $_POST['identifiant'];
    $password = $_POST['password'];

    //Si identifiant et password correspondent à admin alors la connexion est effectuée et l'on navigue vers la page secret.php
    if ($identifiant === 'admin' && $password === 'admin') {
        $_SESSION['loggedIn'] = true;
        header("Location: secret.php");
        exit();
    } else {
        $error = "Identifiants incorrects. Veuillez réessayer.";
    }
}


include 'index.phtml';
