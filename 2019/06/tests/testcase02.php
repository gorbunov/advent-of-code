<?php declare(strict_types=1);

require_once __DIR__.'/../../shared/autoload.php';

$orbits = file('./orbitmap2.txt', FILE_IGNORE_NEW_LINES);

$map = \Orbiting\OrbitMap::createFromMap($orbits);

$path = $map->getBranch('K', 'COM');
print_array_values($path);

