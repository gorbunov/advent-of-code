<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$directions = explode(',', file_get_contents('./directions.txt'));
$directions = array_map('trim', $directions);

$map = new \CityMap\MapPosition();
foreach ($directions as $direction) {
    $turn = $direction[0];
    $distance = (int)substr($direction, 1);
    // printf("Turning: %s, Moving %d steps %s\n", $turn, $distance, $map->getOrientation());
    switch ($turn) {
        case 'R':
            $map->turnRight();
            break;
        case 'L':
            $map->turnLeft();
            break;
    }
    $map->moveForward($distance);
}

printf("Taxicab distance: %d\n", $map->getTaxicabDistance());
