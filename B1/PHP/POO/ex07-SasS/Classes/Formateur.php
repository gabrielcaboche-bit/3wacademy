<?php

class Formateur extends Utilisateur {
    protected $specialite;

    public function __construct($nom, $email) {
        parent::__construct($nom, $email);
        $this->specialite = "Mathématiques";
    }
    public function getRole() {
        return "je suis un formateur";
    }

    public function enseigner() {
        return "Je suis en train d'enseigner";
    }

    public function sePresenter(){
        return parent::sePresenter() . " et je suis un formateur spécialisé en " . $this->specialite;
    }
}