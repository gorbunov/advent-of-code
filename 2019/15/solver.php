<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';
$program = file_get_contents('./program.txt', false);

$droid = \Repairing\RepairDroid::create($program);

$droid->run();
