<?php

namespace Controllers;

use Repositories\ProductRepository;
use Models\Product;

class ProductController {
    public function index() {
        $repository = new ProductRepository();
        $products = $repository->findAll();
        
        // This relies on having a views/product/product.phtml file
        // Or views/layout.phtml
        $template = __DIR__ . '/../views/product/product.phtml';
        
        if (file_exists(__DIR__ . '/../views/layout.phtml')) {
            require_once __DIR__ . '/../views/layout.phtml';
        } else {
            echo "Layout manquant !";
        }
    }
}
