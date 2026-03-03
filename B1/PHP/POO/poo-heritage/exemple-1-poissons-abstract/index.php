<?php

require "Fish.php";
require "Pike.php";
require "Zander.php";

// créer une instance de la classe abstraite
// $fish = new Fish();//ERROR Cannot instantiate abstract class
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




