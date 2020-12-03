<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$mapSource = file('./map-example.txt', FILE_IGNORE_NEW_LINES);
$mapSource = file('./map.txt', FILE_IGNORE_NEW_LINES);

$map = \GeoMap\TreeMap::load($mapSource);
$position = Position2D::create(0, 0);

$slopes = [
    [1, 1],
    [3, 1],
    [5, 1],
    [7, 1],
    [1, 2]
];
$treeSlopes = array_map(fn($slope) => $map->checkSlope($slope[0], $slope[1]), $slopes);

printf("Trees encountered: %d\n", array_product($treeSlopes));
