<?php

namespace Repositories;

use PDO;
use Models\Product;

class ProductRepository {
    private $db;

    public function __construct() {
        $this->db = new PDO("mysql:host=localhost;charset=utf8;dbname=blog", "root", "");
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function findAll() {
        $stmt = $this->db->query("SELECT * FROM products");
        $products = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $product = new Product();
            $product->setId($row['id'] ?? null); 
            $product->setName($row['name'] ?? 'Nom du produit'); 
            $product->setPrice($row['price'] ?? 0);
            
            $products[] = $product;
        }
        
        return $products;
    }
}
