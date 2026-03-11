<?php

require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../repositories/ProductRepository.php';

class ProductController
{
    public function add(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name  = $_POST['name'] ?? '';
            $price = (float) ($_POST['price'] ?? 0);

            try {
                $product = new Product($name, $price);

                $pdo = new PDO('mysql:host=localhost;dbname=mon_projet_MVC;charset=utf8', 'root', 'root');
                $repository = new ProductRepository($pdo);
                $repository->add($product);
                
                // Rediriger ou afficher un succès si besoin
            } catch (InvalidArgumentException $e) {
                $error = $e->getMessage();
            }
        }

        $title = 'Ajouter un produit';
        $view  = __DIR__ . '/../views/product/product.phtml';

        require __DIR__ . '/../views/layout.phtml';
    }
}
