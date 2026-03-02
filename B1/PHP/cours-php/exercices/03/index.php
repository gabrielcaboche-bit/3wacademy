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

function addPoint($quiz, $minimumPoint, $maximumPoint):array{
    foreach($quiz as $key => $question) {
        $randomPoint = rand($minimumPoint, $maximumPoint);
        $quiz[$key]['point'] = $randomPoint;
    }
    return $quiz;
}

$quiz = addPoint($quiz, 1, 5);
// Inclusion du template
require 'index.phtml';
