<?php
function multiply(float $x, float $y) : float {
    return $x * $y;
}

function getNameFromUser(array $user): ?string {
    if (isset($user['name']) && is_string($user['name'])){
        return $user['name'];
    }

    return null;
}

$utilisateur = ['name' => 'Alice'];

echo getNameFromUser($utilisateur)

?>;