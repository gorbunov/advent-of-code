<?php declare(strict_types=1);

use WireGrid\Wire;
use WireGrid\Position;

require_once __DIR__.'/../../shared/autoload.php';

$wire = Wire::createFromString('R8,U5,L5,D3');
$wire2 = Wire::createFromString('U7,R6,D4,L4');

print_array_values($wire->lines());
print_array_values($wire2->lines());
$points = $wire->getIntersectionPoints($wire2);
print_array_values($points);
printf("First wire, steps to position: %d\n", $wire->stepsToPosition(Position::create(3, 3)));
printf("Second wire, steps to position: %d\n", $wire2->stepsToPosition(Position::create(3, 3)));
