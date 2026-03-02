<?php
require_once 'Classes/Avatar.php';
require_once 'Classes/Svg.php';

$avatar = new Avatar(6);
$avatar->defineColors(4);

$svg = new Svg($avatar->getSize(), $avatar->getRandom());
$code = $svg->render();

require_once 'index.phtml';