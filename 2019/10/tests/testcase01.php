<?php declare(strict_types=1);
require_once __DIR__.'/../../shared/autoload.php';

$fixtures = [
    1 => ['(3,4)', 8],
    2 => ['(5,8)', 33],
    3 => ['(1,2)', 35],
    4 => ['(6,3)', 41],
    5 => ['(11,13)', 210],
];

foreach ($fixtures as $number => $fixture) {
    $map = file(sprintf('./testmap%02d.txt', $number), FILE_IGNORE_NEW_LINES);
    $map = \Asteroids\Map::load($map);
    $best = $map->bestStationLocation();
    $matched = ((string)$best[0] === $fixture[0]) && ($best[1] === $fixture[1]);
    if (assert($matched, "Not matched\n")) {
        printf("Best location is %s, with %d detections\n", ...$best);
    }
}

/*
foreach ($map->asteroids() as $asteroid) {
    printf('Asteroid: %s;', $asteroid);
    printf("Detected: %d\n", $map->uniqueAnglesFrom($asteroid));
}
*/
//var_dump(\Asteroids\Position::create(3, 4)->angle(\Asteroids\Position::create(1, 0)));
//var_dump(\Asteroids\Position::create(3, 4)->angle(\Asteroids\Position::create(2, 2)));
