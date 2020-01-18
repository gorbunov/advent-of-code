<?php declare(strict_types=1);

use Orbiting\OrbitMap;

require_once __DIR__.'/../../shared/autoload.php';

$orbits = file('./orbitmap2.txt', FILE_IGNORE_NEW_LINES);

$map = OrbitMap::createFromMap($orbits);

$path = $map->getBranch('K', 'COM');
print_array_values($path);

$path2 = $map->getBranch('SAN', 'COM');
print_array_values($path2);

print_array_values([$map->getIntersection('K', 'SAN')]);
print_array_values($map->getPath('YOU', 'SAN'));

