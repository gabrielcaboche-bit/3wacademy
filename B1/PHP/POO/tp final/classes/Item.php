<?php

abstract class Item {
    private string $title;
    private string $author;
    private string $image;

    public function __construct(string $title, string $author, string $image) {
        $this->setTitle($title);
        $this->setAuthor($author);
        $this->setImage($image);
    }

    // Getters
    public function getTitle(): string {
        return $this->title;
    }

    public function getAuthor(): string {
        return $this->author;
    }

    public function getImage(): string {
        return $this->image;
    }

    // Setters
    public function setTitle(string $title): void {
        if (empty(trim($title))) {
            throw new InvalidArgumentException("Le titre ne peut pas être vide.");
        }
        $this->title = htmlspecialchars(trim($title));
    }

    public function setAuthor(string $author): void {
        if (empty(trim($author))) {
            throw new InvalidArgumentException("L'auteur ne peut pas être vide.");
        }
        $this->author = htmlspecialchars(trim($author));
    }

    public function setImage(string $image): void {
        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        if (!in_array($ext, $allowed)) {
            throw new InvalidArgumentException("L'extension de l'image n'est pas valide.");
        }
        $this->image = $image;
    }

    // Méthode abstraite à implémenter dans les classes filles
    abstract public function getInfo(): string;
}
