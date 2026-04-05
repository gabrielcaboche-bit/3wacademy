<?php
namespace Repository;

use PDO;
use PDOException;
use Services\Database;

class RoomRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM rooms");
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM rooms WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create($name) {
        $stmt = $this->db->prepare("INSERT INTO rooms (name) VALUES (:name)");
        $stmt->execute(['name' => $name]);
    }

    public function update($id, $name) {
        $stmt = $this->db->prepare("UPDATE rooms SET name = :name WHERE id = :id");
        $stmt->execute(['id' => $id, 'name' => $name]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM rooms WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}