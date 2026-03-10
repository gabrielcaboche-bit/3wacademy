<?php

require_once __DIR__ . '/../models/Product.php';

class ProductRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function add(Product $product): void
    {
        $stmt = $this->pdo->prepare('INSERT INTO products (name, price) VALUES (:name, :price)');
        $stmt->execute([
            ':name'  => $product->getName(),
            ':price' => $product->getPrice(),
        ]);
    }
}
