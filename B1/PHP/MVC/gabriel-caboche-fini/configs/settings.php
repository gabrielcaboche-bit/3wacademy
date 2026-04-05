<?php

return [
    'database' => [
        'host' => 'localhost',
        'dbname' => 'gabriel_caboche_chat',
        'user' => 'root',
        'password' => 'root'
    ],
    'routes' => [
        '/' => ['controller' => 'Controllers\\RoomController', 'action' => 'index'],
        '/room' => ['controller' => 'Controllers\\RoomController', 'action' => 'show'],
        '/room/create' => ['controller' => 'Controllers\\RoomController', 'action' => 'create'],
        '/message/create' => ['controller' => 'Controllers\\MessageController', 'action' => 'create'],
        '/message/pin' => ['controller' => 'Controllers\\MessageController', 'action' => 'pin'],
        '/about' => ['controller' => 'Controllers\\AboutController', 'action' => 'index']
    ]
];
