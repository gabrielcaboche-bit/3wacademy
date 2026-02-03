<?php

require 'connexion.php';

//récupération de l'identifiant de la catégorie
if(isset($_GET['id'])){
    $id = $_GET['id'];
    //récupération de la liste des produits de cette catégorie
    $query = $db->prepare('SELECT * FROM products INNER JOIN products_categories ON products.id =  products_categories.product_id  WHERE category_id = ?');
    $query->execute([$id]);
    $products = $query->fetchAll();
    
    //récupération du title de la catégorie pour la mettre en h1
    $query = $db->prepare('SELECT * FROM categories  WHERE id = ?');
    $query->execute([$id]);
    $category = $query->fetch();
}




include "categorie.phtml";

