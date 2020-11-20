<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$directions = file('./directions.txt', FILE_IGNORE_NEW_LINES);

$commands = \Christmas\LightsGrid\CommandsList::parse($directions);
$lights = \Christmas\LightsGrid::create();

foreach ($commands as $command) {
    $lights->apply($command);
}

printf("Turned on lights: %d\n", $lights->countPoweredLights());
