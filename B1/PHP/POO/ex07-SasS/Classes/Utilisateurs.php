<?php
class Utilisateur {
    protected $nom;
    protected $email;

    public function __construct($nom, $email) {
        $this->nom = $nom;
        $this->email = $email;
    }

    public function getInfos() {
        return "Nom: " . $this->nom . ", Email: " . $this->email;
    }

    public function getRole() {
        return "je suis un utilisateur";
    }

    public function sePresenter(){
        return "Je m'appelle " . $this->nom;
    }

}