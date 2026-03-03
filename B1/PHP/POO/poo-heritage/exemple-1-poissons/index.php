<?php

require "Fish.php";
require "Pike.php";
require "Zander.php";

//créer des objets 
$pike = new Pike();
$zander = new Zander();

// appel à la méthode swim()
$pike -> swim();
echo "<br>";
$pike -> ambush();
// $zander -> ambush(); //??? Faux
echo "<br>";
$zander -> swim();
echo "<br>";
$zander -> school();




