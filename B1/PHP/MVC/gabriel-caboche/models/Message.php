<?php
namespace Models; 

class Message {
    private $id;
    private $content;
    private $room_id;
    private $is_pinned;
    private $created_at;
    private $updated_at;

    public function __construct($id, $content, $room_id, $is_pinned, $created_at, $updated_at)
    {
        $this->id = $id;
        $this->content = $content;
        $this->room_id = $room_id;
        $this->is_pinned = $is_pinned;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getRoomId()
    {
        return $this->room_id;
    }

    public function setRoomId($room_id)
    {
        $this->room_id = $room_id;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }

    public function getIsPinned()
    {
        return $this->is_pinned;
    }

    public function setIsPinned($is_pinned)
    {
        $this->is_pinned = $is_pinned;
    }
}