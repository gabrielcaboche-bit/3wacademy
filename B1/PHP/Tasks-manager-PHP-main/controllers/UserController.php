<?php
require 'models/task.php';


function dashboard()
{
    global $pdo;
    if (!isset($_SESSION['user'])) {
        header('Location: index.php?page=login');
        exit;
    }

    $error = null;
    $success = null;

    try {
        $tasks = getTasks($pdo, $_SESSION['user']['id']);
    } catch (PDOException $e) {
        error_log("Dashboard error: " . $e->getMessage());
        $error = "Erreur de base de données lors de la récupération des tâches";
        $tasks = [];
    } catch (Exception $e) {
        error_log("Dashboard error: " . $e->getMessage());
        $error = $e->getMessage();
        $tasks = [];
    }

    // Handle error and success messages from URL parameters
    if (isset($_GET['error'])) {
        $error = urldecode($_GET['error']);
    }

    if (isset($_GET['success'])) {
        $success = $_GET['success'];
        switch ($success) {
            case 'task_created':
                $success = "Tâche créée avec succès !";
                break;
            case 'task_deleted':
                $success = "Tâche supprimée avec succès !";
                break;
            case 'task_completed':
                $success = "Tâche terminée avec succès !";
                break;
            case 'task_updated':
                $success = "Tâche mise à jour avec succès !";
                break;
        }
    }

    require 'views/dashboard.phtml';
}