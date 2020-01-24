<?php declare(strict_types=1);
require_once __DIR__.'/../../shared/autoload.php';
$system = file('./testcase01.txt', FILE_IGNORE_NEW_LINES);
$system = \Gravity\System::load($system);

printf("\n\nTime: %d, System: %s", $system->time(), $system);
for ($time = 0; $time < 10; $time++) {
    $system->forward();
    printf("\n\nTime: %d, System: %s", $system->time(), $system);
}

