<?php
namespace Controllers;

use Repositories\PostRepository;

class PostController {
    public function index() {
        $postRepository = new PostRepository();
        $posts = $postRepository->findAll();
        
        $template = 'post/list';
        require __DIR__ . '/../views/layout.phtml';
    }

    public function show() {
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            header('Location: /');
            exit;
        }

        $id = (int)$_GET['id'];
        $postRepository = new PostRepository();
        $post = $postRepository->findById($id);

        if (!$post) {
            http_response_code(404);
            echo "Article introuvable";
            exit;
        }

        $template = 'post/show';
        require __DIR__ . '/../views/layout.phtml';
    }
}
