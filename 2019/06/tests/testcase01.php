<?php declare(strict_types=1);

use Orbiting\OrbitMap;

require_once __DIR__.'/../../shared/autoload.php';

$orbits = file('./sample.txt', FILE_IGNORE_NEW_LINES);

$map = OrbitMap::createFromMap($orbits);
assert($map->orbitsCount() === 42);
