<?php declare(strict_types=1);

require_once __DIR__.'/../../shared/autoload.php';

$orbits = file('./sample.txt', FILE_IGNORE_NEW_LINES);

$map = \Orbiting\OrbitMap::createFromMap($orbits);
assert($map->orbitsCount() === 42);
