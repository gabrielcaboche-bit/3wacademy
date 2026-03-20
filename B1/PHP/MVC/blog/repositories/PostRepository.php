<?php
namespace Repositories;

use Services\Database;
use Models\Post;
use PDO;

class PostRepository {
    private PDO $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function findAll(): array {
        $query = $this->db->query("SELECT * FROM post ORDER BY created_at DESC");
        return $query->fetchAll(PDO::FETCH_CLASS, Post::class);
    }

    public function findById(int $id): ?Post {
        $query = $this->db->prepare("SELECT * FROM post WHERE id = :id");
        $query->execute(['id' => $id]);
        $query->setFetchMode(PDO::FETCH_CLASS, Post::class);
        $post = $query->fetch();
        return $post ?: null;
    }
}
