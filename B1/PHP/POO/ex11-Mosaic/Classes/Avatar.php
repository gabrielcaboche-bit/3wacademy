<?php
require_once 'Matrix.php';

class Avatar extends Matrix {

    public function __construct(int $size = 6) {
        parent::__construct();
        $this->size = $size;
    }

    public function getRandom(): array {
        $this->m = [];
        $halfSize = intdiv($this->size, 2);
        
        for ($i = 0; $i < $this->size ; $i++) {
            $this->m[$i] = [];
            
            for ($j = $halfSize; $j < $this->size ; $j++) {
                $this->m[$i][$j] = $this->colors[array_rand($this->colors)];
            }
            
            for ($j = 0; $j < $halfSize; $j++) {
                $this->m[$i][$j] = $this->m[$i][$this->size - 1 - $j];
            }
        }
        return $this->m;
    }
}