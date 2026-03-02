<?php
require 'models/user.php';


function ranking()
{
    global $pdo;
    $ranking = [];
    $error = null;

    try {
        $ranking = getUserRanking($pdo);
    } catch (PDOException $e) {
        $error = "Erreur de base de données: " . $e->getMessage();
    } catch (Exception $e) {
        $error = "Une erreur est survenue: " . $e->getMessage();
    }

    require 'views/ranking.php';
}