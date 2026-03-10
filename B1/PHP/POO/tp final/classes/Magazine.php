<?php

require_once __DIR__ . '/Item.php';

class Magazine extends Item {
    private int $issueNumber;

    public function __construct(string $title, string $author, string $image, int $issueNumber) {
        parent::__construct($title, $author, $image);
        $this->setIssueNumber($issueNumber);
    }

    // Getter
    public function getIssueNumber(): int {
        return $this->issueNumber;
    }

    // Setter
    public function setIssueNumber(int $issueNumber): void {
        if ($issueNumber <= 0) {
            throw new InvalidArgumentException("Le numéro d'édition doit être supérieur à 0.");
        }
        $this->issueNumber = $issueNumber;
    }

    public function getInfo(): string {
        return "Magazine n°" . $this->getIssueNumber();
    }
}
