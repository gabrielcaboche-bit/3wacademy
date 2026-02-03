<?php

require 'connexion.php';

//récupération des catégories de produits

$query = $db->prepare('SELECT * FROM categories');
$query->execute();
$categories = $query->fetchAll();

$template = "index.phtml";

include "layout.phtml";

