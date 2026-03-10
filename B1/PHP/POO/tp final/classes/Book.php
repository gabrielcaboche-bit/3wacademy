<?php

require_once __DIR__ . '/Item.php';

class Book extends Item {
    private int $pageCount;

    public function __construct(string $title, string $author, string $image, int $pageCount) {
        parent::__construct($title, $author, $image);
        $this->setPageCount($pageCount);
    }

    // Getter
    public function getPageCount(): int {
        return $this->pageCount;
    }

    // Setter
    public function setPageCount(int $pageCount): void {
        if ($pageCount <= 0) {
            throw new InvalidArgumentException("Le nombre de pages doit être supérieur à 0.");
        }
        $this->pageCount = $pageCount;
    }

    public function getInfo(): string {
        return "Livre de " . $this->getPageCount() . " pages";
    }
}
