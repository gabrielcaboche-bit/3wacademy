<?php

namespace Controllers;

use Repositories\ProductRepository;

class ProductController {
    public function index() {
        $repository = new ProductRepository();
        $products = $repository->findAll();
        
        $template = __DIR__ . '/../views/product/product.phtml';
        require_once __DIR__ . '/../views/layout.phtml';
    }
}
