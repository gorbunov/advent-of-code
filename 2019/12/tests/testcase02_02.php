<?php declare(strict_types=1);
require_once __DIR__.'/../../shared/autoload.php';
$system = file('./testcase02_02.txt', FILE_IGNORE_NEW_LINES);
$system = \Gravity\System::load($system);

printf("Time: %6d; System:\n%s\n", $system->time(), $system);

printf("Cycle size: %d\n", $system->cycleSize());
