<?php

class Formation {
    private $intitulé;
    private $nbrJours;
    private $stagiaires = [];

    public function __construct(string $intitulé, int $nbrJours, array $stagiaires) {
        $this->intitulé = $intitulé;
        $this->nbrJours = $nbrJours;
        $this->stagiaires = $stagiaires;
    }

    public function calculerMoyenneFormation(){
        if (count($this->stagiaires) === 0) {
            return 0; 
        }
        $sommeMoyennes = 0;
        foreach ($this->stagiaires as $stagiaire) {
            $sommeMoyennes += $stagiaire->calculerMoyenne();
        }
        return $sommeMoyennes / count($this->stagiaires);
    }

    public function afficherIndexMax(){
        if (count($this->stagiaires) === 0) {
            return -1;
        }
        $moyenneMax = -1;
        $indexMax = 0;
        foreach ($this->stagiaires as $index => $stagiaire) {
            $moyenne = $stagiaire->calculerMoyenne();
            if ($moyenne > $moyenneMax) {
                $moyenneMax = $moyenne;
                $indexMax = $index;
            }
        }
        return $indexMax;
    }

    public function afficherNomMax(){
        $indexMax = $this->afficherIndexMax();
        if ($indexMax === -1) {
            return "Aucun stagiaire";
        }
        return $this->stagiaires[$indexMax]->getNom();
    }

    public function afficherMinMax(){
        if (count($this->stagiaires) === 0) {
            return "Aucun stagiaire";
        }
        $indexMax = $this->afficherIndexMax();
        $noteMin = $this->stagiaires[$indexMax]->trouverMin();
        return $noteMin;
    }

    public function trouverMoyenneParNom(string $nom){
        foreach ($this->stagiaires as $stagiaire) {
            if ($stagiaire->getNom() === $nom) {
                return $stagiaire->calculerMoyenne();
            }
        }
        return null;
    }
    public function getIntitulé() {
        return $this->intitulé;
    }
    public function setIntitulé($intitulé) {
        $this->intitulé = $intitulé;
    }

    public function getNbrJours() {
        return $this->nbrJours;
    }

    public function setNbrJours($nbrJours) {
        $this->nbrJours = $nbrJours;
    }   

    public function getStagiaires() {
        return $this->stagiaires;
    }

    public function setStagiaires($stagiaires) {
        $this->stagiaires = $stagiaires;
    }
}
