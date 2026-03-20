<?php
namespace Controllers;

use Repository\RoomRepository;
use Repository\MessageRepository;

class RoomController {
    public function index() {
        $roomRepository = new RoomRepository();
        $rooms = $roomRepository->getAll();
        
        $template = 'room/index';
        require __DIR__ . '/../views/layout.phtml';
    }

    public function show() {
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            $base = dirname($_SERVER['SCRIPT_NAME']);
            header('Location: ' . ($base === '\\' ? '' : $base) . '/');
            exit;
        }

        $id = (int)$_GET['id'];
        $roomRepository = new RoomRepository();
        $rooms = $roomRepository->getAll(); // For sidebar
        $room = $roomRepository->getById($id);

        if (!$room) {
            http_response_code(404);
            echo "Salon introuvable";
            exit;
        }

        $messageRepository = new MessageRepository();
        $messages = $messageRepository->getByRoomId($id);

        $template = 'room/show';
        require __DIR__ . '/../views/layout.phtml';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['name'])) {
            $roomRepository = new RoomRepository();
            $roomRepository->create($_POST['name']);
        }
        $base = dirname($_SERVER['SCRIPT_NAME']);
        header('Location: ' . ($base === '\\' ? '' : $base) . '/');
        exit;
    }
}