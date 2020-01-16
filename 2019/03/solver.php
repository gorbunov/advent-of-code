<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';
$wires = file('./wires.txt');
$grid = \WireGrid\Grid::createFromWires($wires);

printf("Closest interseption: %d\n", $grid->closest());
printf("Fastest interseption: %d\n", $grid->fastest());
