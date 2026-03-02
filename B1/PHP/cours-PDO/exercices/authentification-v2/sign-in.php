<?php

include 'connexion.php';


if (!empty($_POST)) {
    $identifiant = $_POST['identifiant'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = $db->prepare('INSERT INTO `users`(`username`, `email`, `password`) VALUES (?,?,?)');
    $query->execute([$identifiant, $email, $password]);
    $categories = $query->fetchAll();
}


