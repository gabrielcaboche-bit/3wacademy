<?php

require_once __DIR__ . '/../services/Database.php';

class Article {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM articles");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($title) {
        $stmt = $this->db->prepare("INSERT INTO articles (title) VALUES (:title)");
        $stmt->execute(['title' => $title]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM articles WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
