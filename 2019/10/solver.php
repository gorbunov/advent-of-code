<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';
$map = file('./asteroids.txt', FILE_IGNORE_NEW_LINES);

$map = \Asteroids\Map::load($map);

[$position, $detections] = $map->bestStationLocation();
printf("Best location is %s, with %d detections\n", $position, $detections); // Best location is (17,22), with 288 detections
/** @var \Asteroids\Position[] $vaporized */
$vaporized = $map->vaporize($position);

printf("200th asteroid: at %s, %d\n", $vaporized[200], $vaporized[200]->x() * 100 + $vaporized[200]->y());
