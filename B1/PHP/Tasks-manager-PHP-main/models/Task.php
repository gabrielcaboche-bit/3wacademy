<?php
function createTask($pdo, $title, $urgent, $important, $user_id)
{
    try {
        if ($urgent == NULL) {
            $urgent = 0;
        }
        if ($important == NULL) {
            $important = 0;
        }

        $stmt = $pdo->prepare('INSERT INTO task (title,is_urgent,is_important,user_id) VALUES (?,?,?,?)');
        $result = $stmt->execute([$title, $urgent, $important, $user_id]);

        if (!$result) {
            throw new Exception("Erreur lors de la création de la tâche");
        }

        return $pdo->lastInsertId();
    } catch (PDOException $e) {
        error_log("Erreur PDO dans createTask: " . $e->getMessage());
        throw new Exception("Erreur de base de données lors de la création de la tâche");
    } catch (Exception $e) {
        error_log("Erreur dans createTask: " . $e->getMessage());
        throw $e;
    }
}


function getTasks($pdo, $user_id)
{
    try {
        $sql = 'SELECT * FROM task WHERE user_id = ? AND is_done = 0 ORDER BY is_urgent DESC, is_important DESC';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Erreur PDO dans getTasks: " . $e->getMessage());
        throw new Exception("Erreur de base de données lors de la récupération des tâches");
    } catch (Exception $e) {
        error_log("Erreur dans getTasks: " . $e->getMessage());
        throw $e;
    }
}


function getTask($pdo, $id, $user_id)
{
    try {
        $stmt = $pdo->prepare('SELECT * FROM task WHERE id = ? AND user_id = ?');
        $stmt->execute([$id, $user_id]);
        return $stmt->fetch();
    } catch (PDOException $e) {
        error_log("Erreur PDO dans getTask: " . $e->getMessage());
        throw new Exception("Erreur de base de données lors de la récupération de la tâche");
    } catch (Exception $e) {
        error_log("Erreur dans getTask: " . $e->getMessage());
        throw $e;
    }
}


function updateTask($pdo, $title, $urgent, $important, $done, $id, $user_id)
{
    try {
        $stmt = $pdo->prepare('UPDATE task SET title=?, is_urgent=?, is_important=?, is_done=? WHERE id=? AND user_id=?');
        $result = $stmt->execute([$title, $urgent, $important, $done, $id, $user_id]);

        if (!$result) {
            throw new Exception("Erreur lors de la mise à jour de la tâche");
        }

        return $result;
    } catch (PDOException $e) {
        error_log("Erreur PDO dans updateTask: " . $e->getMessage());
        throw new Exception("Erreur de base de données lors de la mise à jour de la tâche");
    } catch (Exception $e) {
        error_log("Erreur dans updateTask: " . $e->getMessage());
        throw $e;
    }
}


function deleteTask($pdo, $id, $user_id)
{
    try {
        $stmt = $pdo->prepare('DELETE FROM task WHERE id=? AND user_id=?');
        $result = $stmt->execute([$id, $user_id]);

        if (!$result) {
            throw new Exception("Erreur lors de la suppression de la tâche");
        }

        return $result;
    } catch (PDOException $e) {
        error_log("Erreur PDO dans deleteTask: " . $e->getMessage());
        throw new Exception("Erreur de base de données lors de la suppression de la tâche");
    } catch (Exception $e) {
        error_log("Erreur dans deleteTask: " . $e->getMessage());
        throw $e;
    }
}


function markTaskAsDone($pdo, $id, $user_id)
{
    try {
        $stmt = $pdo->prepare('UPDATE task SET is_done=1 WHERE id=? AND user_id=?');
        $result = $stmt->execute([$id, $user_id]);

        if (!$result) {
            throw new Exception("Erreur lors du marquage de la tâche comme terminée");
        }

        return $result;
    } catch (PDOException $e) {
        error_log("Erreur PDO dans markTaskAsDone: " . $e->getMessage());
        throw new Exception("Erreur de base de données lors du marquage de la tâche");
    } catch (Exception $e) {
        error_log("Erreur dans markTaskAsDone: " . $e->getMessage());
        throw $e;
    }
}


function deleteCompletedTasks($pdo, $user_id)
{
    try {
        $stmt = $pdo->prepare('DELETE FROM task WHERE is_done=1 AND user_id=?');
        $result = $stmt->execute([$user_id]);

        if (!$result) {
            throw new Exception("Erreur lors de la suppression des tâches terminées");
        }

        return $result;
    } catch (PDOException $e) {
        error_log("Erreur PDO dans deleteCompletedTasks: " . $e->getMessage());
        throw new Exception("Erreur de base de données lors de la suppression des tâches terminées");
    } catch (Exception $e) {
        error_log("Erreur dans deleteCompletedTasks: " . $e->getMessage());
        throw $e;
    }
}