<?php declare(strict_types=1);

require_once __DIR__.'/../../shared/autoload.php';

$orbits = file('./sample.txt');

$map = \Orbiting\OrbitMap::createFromMap($orbits);
