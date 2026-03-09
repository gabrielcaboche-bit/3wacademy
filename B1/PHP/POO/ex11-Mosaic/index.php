<?php
require_once 'Classes/Avatar.php';
require_once 'Classes/Draw.php';
require_once 'Classes/Svg.php';

$avatar = new Avatar(6);
$avatar->defineColors(4);
$svgAvatar = new Svg($avatar->getSize(), $avatar->getRandom());
$codeAvatar = $svgAvatar->render();

$dessin = new Draw();
$dessin->defineLine(0,1,1,0,1,1,0);
$dessin->defineLine(1,1,1,1,1,1,1);
$dessin->defineLine(1,1,1,1,1,1,1);
$dessin->defineLine(0,1,1,0,0,1,0);
$dessin->defineLine(0,0,1,1,1,0,0);
$dessin->defineLine(0,0,0,1,0,0,0);
$dessin->defineLine(0,0,0,0,0,0,1);

$svgDraw = new Svg($dessin->getSize(), $dessin->getM());
$codeDraw = $svgDraw->render();

require_once 'index.phtml';
