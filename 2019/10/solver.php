<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';
$map = file('./asteroids.txt', FILE_IGNORE_NEW_LINES);

$map = \Asteroids\Map::load($map);

print_array_values($map->anglesToAsteroidsFrom(\Asteroids\Position::create(10, 10)));

//var_dump(\Asteroids\Position::create(3, 4)->angle(\Asteroids\Position::create(1, 0)));
//var_dump(\Asteroids\Position::create(3, 4)->angle(\Asteroids\Position::create(2, 2)));
