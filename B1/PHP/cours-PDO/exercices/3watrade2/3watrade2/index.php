<?php

require 'connexion.php';

//récupération des catégories de produits

$query = $db->prepare('SELECT * FROM categories');
$query->execute();
$categories = $query->fetchAll();

include "index.phtml";

