<?php
// importer la classe Movie 
require 'Movie.php';

// créer une insatnce 
// instancie la classe Movie 
// créer un objet a partir de la classe Movie
$movie = new Movie();
// initialiser les props
// donner des valeur de départ aux props
$movie->year = 100;
$movie->title = "Matrix";
echo $movie->title;
var_dump($movie);