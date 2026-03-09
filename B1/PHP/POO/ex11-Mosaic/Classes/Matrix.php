<?php
require_once 'Utils.php';

abstract class Matrix {
    protected int $size;
    protected array $colors = [];
    protected array $m = [];

    public function __construct() {
        $this->size = 6;
        $this->setColors([Utils::getRandomColor(), Utils::getRandomColor()]);
    }

    public function setSize(int $size): void {
        $this->size = $size;
    }

    public function getSize(): int {
        return $this->size;
    }

    public function setColors(array $colors): void {
        $this->colors = $colors;
    }

    public function defineColors(int $numberOfColors = 2): void {
        $this->colors = [];
        for ($i = 0; $i < $numberOfColors; $i++) {
            $this->colors[] = Utils::getRandomColor();
        }
    }

    public function getM(): array {
        return $this->m;
    }
}
