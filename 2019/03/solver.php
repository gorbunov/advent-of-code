<?php declare(strict_types=1);

use WireGrid\Grid;

require_once __DIR__.'/../shared/autoload.php';
$wires = file('./wires.txt');
$grid = Grid::createFromWires($wires);

printf("Closest interseption: %d\n", $grid->closest());
printf("Fastest interseption: %d\n", $grid->fastest());
