<?php
// Données du quiz (tableau associatif)
$quiz = [
    'question' => 'Quelle est la capitale de la France ?',
    'answers' => [
        'Paris',
        'Lyon',
        'Marseille'
    ],
    'correct_answer' => 'Paris'
];

// Inclusion du template
require 'index.phtml';
