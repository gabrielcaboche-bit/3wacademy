<?php

class Product
{
    private string $name;
    private float $price;

    public function __construct(string $name, float $price)
    {
        $this->setName($name);
        $this->setPrice($price);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        if (!preg_match('/^[a-zA-Z0-9 ]+$/', $name)) {
            throw new InvalidArgumentException("Le nom du produit n'est pas valide (lettres, chiffres et espaces uniquement).");
        }
        $this->name = $name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        if ($price < 0) {
            throw new InvalidArgumentException("Le prix doit être un nombre positif.");
        }
        $this->price = $price;
    }
}
