<?php
require 'models/task.php';


function handleTask()
{
    global $pdo;
    if (!isset($_SESSION['user'])) {
        header('Location: index.php?page=login');
        exit;
    }

    $error = null;

    try {
        if ($_POST) {
            // Validate title
            if (empty($_POST['title'])) {
                $error = "Le titre de la tâche est requis";
            } else {
                $taskId = createTask($pdo, $_POST['title'], $_POST['urgent'], $_POST['important'], $_SESSION['user']['id']);
                if ($taskId) {
                    header('Location: index.php?page=dashboard&success=task_created');
                    exit;
                } else {
                    $error = "Erreur lors de la création de la tâche";
                }
            }
        }
        if (isset($_GET['delete'])) {
            deleteTask($pdo, $_GET['delete'], $_SESSION['user']['id']);
            header('Location: index.php?page=dashboard&success=task_deleted');
            exit;
        }
        if (isset($_GET['done'])) {
            markTaskAsDone($pdo, $_GET['done'], $_SESSION['user']['id']);
            header('Location: index.php?page=dashboard&success=task_completed');
            exit;
        }
    } catch (PDOException $e) {
        error_log("Task error: " . $e->getMessage());
        $error = "Erreur de base de données lors de l'opération sur la tâche";
    } catch (Exception $e) {
        error_log("Task error: " . $e->getMessage());
        $error = $e->getMessage();
    }

    // If there's an error, redirect to dashboard with error message
    if ($error) {
        header('Location: index.php?page=dashboard&error=' . urlencode($error));
        exit;
    }

    header('Location: index.php?page=dashboard');
    exit;
}


function editTask()
{
    global $pdo;
    if (!isset($_SESSION['user'])) {
        header('Location: index.php?page=login');
        exit;
    }

    $task = null;
    $error = null;

    try {
        $task = getTask($pdo, $_GET['id'], $_SESSION['user']['id']);

        if (!$task) {
            $error = "Tâche non trouvée";
        } elseif ($_POST) {
            // Validate title
            if (empty($_POST['title'])) {
                $error = "Le titre de la tâche est requis";
            } else {
                $done = isset($_POST['done']) ? $_POST['done'] : 0;
                $urgent = isset($_POST['urgent']) ? $_POST['urgent'] : 0;
                $important = isset($_POST['important']) ? $_POST['important'] : 0;
                updateTask($pdo, $_POST['title'], $urgent, $important, $done, $task['id'], $_SESSION['user']['id']);
                header('Location: index.php?page=dashboard&success=task_updated');
                exit;
            }
        }
    } catch (PDOException $e) {
        error_log("Edit task error: " . $e->getMessage());
        $error = "Erreur de base de données lors de la mise à jour de la tâche";
    } catch (Exception $e) {
        error_log("Edit task error: " . $e->getMessage());
        $error = $e->getMessage();
    }

    require 'views/edit_task.php';
}