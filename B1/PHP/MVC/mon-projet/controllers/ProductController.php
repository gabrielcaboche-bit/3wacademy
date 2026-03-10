<?php

class ProductController
{
    public function add(): void
    {
        $title = 'Ajouter un produit';
        $view = __DIR__ . '/../views/product/product.phtml';

        require __DIR__ . '/../views/layout.phtml';
    }
}
