<?php
session_start();

$page = $_GET['page'] ?? 'home';

try {
    require 'config/database.php';

    switch ($page) {
        case 'register':
            require 'controllers/AuthController.php';
            register();
            break;
        case 'login':
            require 'controllers/AuthController.php';
            login();
            break;
        case 'logout':
            require 'controllers/AuthController.php';
            logout();
            break;
        case 'dashboard':
            require 'controllers/UserController.php';
            dashboard();
            break;
        case 'task':
            require 'controllers/TaskController.php';
            handleTask();
            break;
        case 'edit-task':
            require 'controllers/TaskController.php';
            editTask();
            break;
        case 'ranking':
            require 'controllers/RankingController.php';
            ranking();
            break;
        default:
            require 'views/home.php';
    }
} catch (PDOException $e) {
    error_log("Application error (PDO): " . $e->getMessage());
    echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Erreur</title></head><body>';
    echo '<h1>Erreur de base de données</h1>';
    echo '<p>Une erreur est survenue lors de l\'accès à la base de données.</p>';
    echo '<p><a href="index.php">Retour à l\'accueil</a></p>';
    echo '</body></html>';
} catch (Exception $e) {
    error_log("Application error: " . $e->getMessage());
    echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Erreur</title></head><body>';
    echo '<h1>Erreur</h1>';
    echo '<p>Une erreur est survenue: ' . htmlspecialchars($e->getMessage()) . '</p>';
    echo '<p><a href="index.php">Retour à l\'accueil</a></p>';
    echo '</body></html>';
}