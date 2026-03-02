<?php

class Svg {
    public int $size;
    public array $colors;
    public function __construct($size, $colors) {
        $this ->size = $size;
        $this ->colors = $colors;
    }
    public function render() {
        $svg = '<svg width="' . ($this->size * 10) . '" height="' . ($this->size * 10) . '">';
        for ($i = 0; $i < $this->size; $i++) {
            for ($j = 0; $j < $this->size; $j++) {
                $color = $this->colors[$i][$j];
                $svg .= '<rect x="' . ($j * 10) . '" y="' . ($i * 10) . '" width="10" height="10" fill="' . $color . '"/>';
            }
        }
        $svg .= '</svg>';
        return $svg;
    }
}