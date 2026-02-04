<?php
session_start();

if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true) {
    header('location: secret.php');
    exit;
}

if (!empty($_POST)) {
    $identifiant = $_POST['identifiant'];
    $password = $_POST['password'];

    if ($identifiant === "admin" && $password === "admin") {
        $_SESSION['loggedIn'] = true;
        header('location: secret.php');
        exit;
    } else {
        $error = "Identifiant incorrects. Veuillez réessayer.";
    }

}
include 'index.phtml';
