<?php

class Visiteur {
    private static $compteur = 0;
    private $visiteurId;
    public function __construct($visiteurId) {
        $this->visiteurId = $visiteurId;
        self::$compteur++;
        echo $this->visiteurId . " a visité le site.";
        echo "Nombre total de visiteurs: " . self::$compteur . "<br>";
    }

    public static function getCompteur() {
        return self::$compteur;
    }
}