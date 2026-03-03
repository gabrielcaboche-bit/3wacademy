<?php

abstract class Shape {
    private $color;

    public function setColor($color) {
        $this->color = $color;
    }

    abstract public function bonjour();
    function getColor() {
        return $this->color;
    }
}

class Rectangle extends Shape {
        public function bonjour() {
            echo "Bonjour je suis un rectangle de couleur " . $this->getColor();
        }
    }