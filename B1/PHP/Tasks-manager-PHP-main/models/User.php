<?php
function createUser($pdo, $username, $email, $password)
{
    try {
        $stmt = $pdo->prepare('INSERT INTO user (username,email,password) VALUES (?,?,?)');
        $result = $stmt->execute([$username, $email, $password]);

        if (!$result) {
            throw new Exception("Erreur lors de la création de l'utilisateur");
        }

        return $pdo->lastInsertId();
    } catch (PDOException $e) {
        error_log("Erreur PDO dans createUser: " . $e->getMessage());
        throw new Exception("Erreur de base de données lors de la création de l'utilisateur");
    } catch (Exception $e) {
        error_log("Erreur dans createUser: " . $e->getMessage());
        throw $e;
    }
}


function getUserByEmail($pdo, $email)
{
    try {
        $stmt = $pdo->prepare('SELECT * FROM user WHERE email = ?');
        $stmt->execute([$email]);
        return $stmt->fetch();
    } catch (PDOException $e) {
        error_log("Erreur PDO dans getUserByEmail: " . $e->getMessage());
        throw new Exception("Erreur de base de données lors de la récupération de l'utilisateur");
    } catch (Exception $e) {
        error_log("Erreur dans getUserByEmail: " . $e->getMessage());
        throw $e;
    }
}


function getUserRanking($pdo)
{
    try {
        $stmt = $pdo->query('SELECT user.username, COUNT(task.id) as total FROM user LEFT JOIN task ON user.id = task.user_id AND task.is_done = 1 GROUP BY user.id ORDER BY total DESC');
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Erreur PDO dans getUserRanking: " . $e->getMessage());
        throw new Exception("Erreur de base de données lors de la récupération du classement");
    } catch (Exception $e) {
        error_log("Erreur dans getUserRanking: " . $e->getMessage());
        throw $e;
    }
}