<?php

class Administrateur extends Utilisateur {

    public function __construct($nom, $email) {
        parent::__construct($nom, $email);
    }
    public function getRole() {
        return "je suis un administrateur";
    }

    public function gererPlatforme() {
        return "Je gere la platforme";
    }
}