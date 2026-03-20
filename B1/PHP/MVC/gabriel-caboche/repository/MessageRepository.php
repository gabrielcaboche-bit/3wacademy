<?php 
namespace Repository;

use PDO;
use PDOException;
use Services\Database;

class MessageRepository {
    private $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM messages");
        return $stmt->fetchAll();
    }

    public function getByRoomId($room_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM messages WHERE room_id = :room_id ORDER BY is_pinned DESC, created_at ASC");
        $stmt->execute(['room_id' => $room_id]);
        return $stmt->fetchAll();
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM messages WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create($content, $room_id){
        $stmt = $this->db->prepare("INSERT INTO messages (content, room_id) VALUES (:content, :room_id)");
        $stmt->execute(['content' => $content, 'room_id' => $room_id]);
    }

    public function update($id, $content, $room_id){
        $stmt = $this->db->prepare("UPDATE messages SET content = :content, room_id = :room_id WHERE id = :id");
        $stmt->execute(['id' => $id, 'content' => $content, 'room_id' => $room_id]);
    }

    public function delete($id){
        $stmt = $this->db->prepare("DELETE FROM messages WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    public function togglePin($id, $room_id){
        $stmt = $this->db->prepare("SELECT is_pinned FROM messages WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $message = $stmt->fetch();

        if ($message) {
            if ($message['is_pinned']) {
                $stmt = $this->db->prepare("UPDATE messages SET is_pinned = 0 WHERE id = :id");
                $stmt->execute(['id' => $id]);
            } else {
                $stmt = $this->db->prepare("UPDATE messages SET is_pinned = 0 WHERE room_id = :room_id");
                $stmt->execute(['room_id' => $room_id]);
                
                $stmt = $this->db->prepare("UPDATE messages SET is_pinned = 1 WHERE id = :id");
                $stmt->execute(['id' => $id]);
            }
        }
    }
}