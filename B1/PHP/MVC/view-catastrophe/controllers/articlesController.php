<?php

require_once __DIR__ . '/../models/Article.php';

class ArticleController {
    public function index() {
        $model = new Article();
        $articles = $model->getAll();
        require_once __DIR__ . '/../views/articles/index.php';
    }

    public function add() {
        if (isset($_POST['title'])) {
            $model = new Article();
            $model->create($_POST['title']);
        }
        header('Location: original.php');
        exit;
    }

    public function delete() {
        if (isset($_GET['delete'])) {
            $model = new Article();
            $model->delete($_GET['delete']);
        }
        header('Location: original.php');
        exit;
    }
}