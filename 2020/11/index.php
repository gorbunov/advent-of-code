<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$map = file('./seatings.txt', FILE_IGNORE_NEW_LINES);
#$map = file('./seatings-example.txt', FILE_IGNORE_NEW_LINES);

$layout = \Ferry\Layout::load($map);
$step = 0;
while ($layout->seatPassengers()) {
    $step++;
}
echo $layout;
//echo $step;
echo $layout->getSeatedCount();
