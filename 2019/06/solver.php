<?php declare(strict_types=1);

require_once __DIR__.'/../shared/autoload.php';
$orbits = file('./orbits.txt', FILE_IGNORE_NEW_LINES);

$map = \Orbiting\OrbitMap::createFromMap($orbits);

printf("Orbits map checksum: %d\n", $map->orbitsCount());
print_array_values($map->getPath('YOU', 'SAN'));
printf("Transfers required: %d\n", count($map->getPath('YOU', 'SAN'))-1); // -1 transfer for already orbiting start body
