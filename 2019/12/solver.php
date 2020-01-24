<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';
$system = file('./system.txt', FILE_IGNORE_NEW_LINES);
$system = \Gravity\System::load($system);

$system->simulate(1000);

printf("%s\nTotal Energy: %6d\n", $system, $system->energy());
