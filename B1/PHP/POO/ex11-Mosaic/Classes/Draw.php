<?php
require_once 'Matrix.php';

class Draw extends Matrix {
    public function __construct(int $size = 0) {
        parent::__construct();
        $this->size = $size;
    }

    public function defineLine(...$indexes): void {
        $row = [];
        foreach ($indexes as $index) {
            $row[] = $this->colors[$index] ?? '#000000';
        }
        $this->m[] = $row;
        $this->size = max($this->size, count($this->m), count($row));
    }
}
