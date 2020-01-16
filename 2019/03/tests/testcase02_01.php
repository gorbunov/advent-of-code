<?php declare(strict_types=1);
require_once __DIR__.'/../../shared/autoload.php';

$wire = \WireGrid\Wire::createFromString('R8,U5,L5,D3');
$wire2 = \WireGrid\Wire::createFromString('U7,R6,D4,L4');

print_array_values($wire->lines());
print_array_values($wire2->lines());
$points = $wire->getIntersectionPoints($wire2);
print_array_values($points);
var_dump($wire->stepsToPosition(\WireGrid\Position::create(3,3)));
var_dump($wire2->stepsToPosition(\WireGrid\Position::create(3,3)));
