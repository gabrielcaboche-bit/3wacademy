<?php
namespace Controllers;

use Repository\MessageRepository;

class MessageController {
    
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['content']) && !empty($_POST['room_id'])) {
            $roomId = (int)$_POST['room_id'];
            $content = $_POST['content'];

            $messageRepository = new MessageRepository();
            $messageRepository->create($content, $roomId);

            $base = dirname($_SERVER['SCRIPT_NAME']);
            header('Location: ' . ($base === '\\' ? '' : $base) . '/room?id=' . $roomId);
            exit;
        }
        $base = dirname($_SERVER['SCRIPT_NAME']);
        header('Location: ' . ($base === '\\' ? '' : $base) . '/');
        exit;
    }

    public function pin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['message_id']) && !empty($_POST['room_id'])) {
            $messageId = (int)$_POST['message_id'];
            $roomId = (int)$_POST['room_id'];

            $messageRepository = new MessageRepository();
            $messageRepository->togglePin($messageId, $roomId);

            $base = dirname($_SERVER['SCRIPT_NAME']);
            header('Location: ' . ($base === '\\' ? '' : $base) . '/room?id=' . $roomId);
            exit;
        }
        $base = dirname($_SERVER['SCRIPT_NAME']);
        header('Location: ' . ($base === '\\' ? '' : $base) . '/');
        exit;
    }
}