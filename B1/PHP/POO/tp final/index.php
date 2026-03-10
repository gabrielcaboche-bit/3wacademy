<?php

require_once __DIR__ . '/classes/Library.php';
require_once __DIR__ . '/classes/Book.php';
require_once __DIR__ . '/classes/Magazine.php';

// Instanciation de la librairie
$library = new Library();

// Création des items
$book1     = new Book("1984", "George Orwell", "1984.jpg", 328);
$magazine1 = new Magazine("National Geographic", "Divers", "national.webp", 150);
$book2     = new Book("La ligne verte", "Stephen King", "ligneverte.jpg", 1065);
$magazine2 = new Magazine("Ca m'intéresse", "Prisma média", "caminteresse.png", 203);

// Ajout des items à la librairie
$library->addItem($book1);
$library->addItem($magazine1);
$library->addItem($book2);
$library->addItem($magazine2);

// Récupération des items pour affichage
$items = $library->getItems();

require_once 'index.phtml';
