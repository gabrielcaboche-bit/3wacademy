<?php

// Autoloader
spl_autoload_register(function ($class) {
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $parts = explode(DIRECTORY_SEPARATOR, $path);
    // Lowercase the first part to match directory names (controllers, models, etc.)
    $parts[0] = strtolower($parts[0]);
    $file = __DIR__ . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $parts) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

use Services\Router;

$router = new Router();
$router->handleRequest();
