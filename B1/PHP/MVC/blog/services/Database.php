<?php
namespace Services;

use PDO;
use PDOException;

class Database {
    private static ?PDO $instance = null;

    public static function getConnection(): PDO {
        if (self::$instance === null) {
            try {
                $settings = require __DIR__ . '/../configs/settings.php';
                $dbParams = $settings['database'];
                self::$instance = new PDO(
                    "mysql:host={$dbParams['host']};dbname={$dbParams['dbname']};charset=utf8",
                    $dbParams['user'],
                    $dbParams['password'],
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $e) {
                die("Erreur de connexion a la base de donnees : " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}
