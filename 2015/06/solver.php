<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$directions = file('./directions.txt', FILE_IGNORE_NEW_LINES);

$commands = \Christmas\LightsGrid\CommandsList::parse($directions);
$lights = \Christmas\LightsGrid::create(1000, 1000);

foreach ($commands as $command) {
    $lights->applyBrightness($command);
}

printf("Lights total brightness: %d\n", $lights->countPoweredLights());
