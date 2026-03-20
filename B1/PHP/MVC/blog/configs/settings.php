<?php

return [
    'database' => [
        'host' => 'localhost',
        'dbname' => 'mini_blog',
        'user' => 'root',
        'password' => 'root'
    ],
    'routes' => [
        '/' => ['controller' => 'Controllers\\PostController', 'action' => 'index'],
        '/post' => ['controller' => 'Controllers\\PostController', 'action' => 'show']
    ]
];
