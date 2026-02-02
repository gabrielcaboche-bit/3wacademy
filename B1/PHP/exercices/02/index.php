<?php
// Données du quiz (tableau associatif)
$quiz = [
    'first' => [
        'question' => 'Quelle est la capitale de la France ?',
        'answers' => [
            'Paris',
            'Lyon',
            'Marseille'
        ],
        'correct_answer' => 'Paris'],
    'second' => [
        'question' => 'Quel est le plus grand océan du monde ?',
        'answers' => [
            'Océan Atlantique',
            'Océan Indien',
            'Océan Pacifique'
        ],
        'correct_answer' => 'Océan Pacifique'],
    'third' => [
        'question' => 'Qui a peint la Joconde ?',
        'answers' => [
            'Vincent van Gogh',
            'Pablo Picasso',
            'Léonard de Vinci'
        ], 
        'correct_answer' => 'Léonard de Vinci'
    ],
    'fourth' => [
        'question' => 'Quelle est la planète la plus proche du Soleil ?',
        'answers' => [
            'Vénus',
            'Mercure',
            'Mars'
        ],
        'correct_answer' => 'Mercure'
    ],
];

// Inclusion du template
require 'index.phtml';
