<?php

spl_autoload_register(function ($class) {
    // Transforme 'Controllers\ProductController' en 'controllers/ProductController.php'
    $parts = explode('\\', $class);
    $parts[0] = strtolower($parts[0]);
    $classPath = implode('/', $parts);
    
    $file = __DIR__ . '/' . $classPath . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

use Controllers\ProductController;

$controller = new ProductController();

$action = $_GET['action'] ?? 'index';

if ($action === 'index') {
    $controller->index();
}
// Ajouter d'autres actions (add, delete, etc.) si nécessaire