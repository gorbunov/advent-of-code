<?php declare(strict_types=1);

use WireGrid\Wire;

require_once __DIR__.'/../../shared/autoload.php';

/*
 * 'R8,U5,L5,D3',
 * 'U7,R6,D4,L4',
 */
$wire = Wire::createFromString('R8,U5,L5,D3');
$wire2 = Wire::createFromString('U7,R6,D4,L4');

print_array_values($wire->lines());
print_array_values($wire2->lines());
$points = $wire->getIntersectionPoints($wire2);
print_array_values($points);
