<?php

class Etudiant extends Utilisateur {
    protected $niveau;

    public function __construct($nom, $email) {
        parent::__construct($nom, $email);
        $this->niveau = "Débutant";
    }

    public function getRole() {
        return "je suis un étudiant";
    }

    public function etudier() {
        return "Je suis en train d'étudier";
    }
}
