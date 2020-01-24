<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';
$map = file('./asteroids.txt', FILE_IGNORE_NEW_LINES);

$map = \Asteroids\Map::load($map);

printf("Best location is %s, with %d detections\n", ...$map->bestStationLocation());
