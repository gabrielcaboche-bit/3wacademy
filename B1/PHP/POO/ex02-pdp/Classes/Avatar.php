<?php 
require_once 'Utils.php';
class Avatar {
    private int $size = 6;
    private array $colors = [];

    public function __construct($size){
        $this->size = $size;
    }

    public function defineColors($numberOfColors = 4) {
        if(!empty($this->colors)) {
            $this->colors = [];
        }
        for ($i = 0; $i < $numberOfColors; $i++) {
            $this->colors[] = Utils::getRandomColor();
        }
    }

    public function getSize() {
        return $this->size;
    }

    public function setSize($size) {
        $this->size = $size;
    }

    public function getRandom() {
        $randomColors = [];
        $halfSize = intdiv($this->size, 2);
        
        for ($i = 0; $i < $this->size ; $i++) {
            $randomColors[$i] = [];
            
            // Generate random colors for right half (including middle column for odd sizes)
            for ($j = $halfSize; $j < $this->size ; $j++) {
                $randomColors[$i][$j] = $this->colors[array_rand($this->colors)];
            }
            
            // Mirror right half to left half
            for ($j = 0; $j < $halfSize; $j++) {
                $randomColors[$i][$j] = $randomColors[$i][$this->size - 1 - $j];
            }
        }
        return $randomColors;
    }
}