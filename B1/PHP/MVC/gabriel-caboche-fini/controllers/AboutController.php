<?php

namespace Controllers;

class AboutController {
    public function index() {
        $template = 'about/layout';
        require_once __DIR__ . '/../views/layout.phtml';
    }
}
