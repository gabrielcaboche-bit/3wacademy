<?php

require_once __DIR__ . '/Item.php';

class Library {
    private static int $totalItems = 0;
    private array $items = [];

    public function addItem(Item $item): void {
        $this->items[] = $item;
        self::$totalItems++;
    }

    public function getItems(): array {
        return $this->items;
    }

    public static function getTotalItems(): int {
        return self::$totalItems;
    }
}
