<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$program = file_get_contents('./program.txt', false);

$robot = \Painting\Robot\PainterRobot::create($program);

$robot->paint();
printf("Panels painted: %d\n", $robot->hull()->painted());
