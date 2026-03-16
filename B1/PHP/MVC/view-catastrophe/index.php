<?php
require_once __DIR__ . '/controllers/articlesController.php';

$controller = new ArticleController();

$action = $_GET['action'] ?? 'index';

if ($action === 'add') {
    $controller->add();
} elseif ($action === 'delete') {
    $controller->delete();
} else {
    $controller->index();
}