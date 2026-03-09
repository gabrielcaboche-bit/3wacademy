<?php

class Stagiaire {
    private $nom;
    private array $notes = [];

    public function __construct(string $nom, array $notes) {
        $this->nom = $nom;
        $this->notes = $notes;
    }

    public function calculerMoyenne() {
        if (count($this->notes) === 0) {
            return 0; 
        }
        $somme = array_sum($this->notes);
        return $somme / count($this->notes);
    }

    public function trouverMax() {
        if (count($this->notes) === 0) {
            return null; 
        }
        return max($this->notes);
    }

    public function trouverMin() {
        if (count($this->notes) === 0) {
            return null; 
        }
        return min($this->notes);
    }

    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function getNotes() {
        return $this->notes;
    }

    public function setNotes($notes) {
        $this->notes = $notes;
    }


}