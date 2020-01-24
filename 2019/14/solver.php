<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$lines = file('./reactions.txt', FILE_IGNORE_NEW_LINES);
$station = \Chemistry\Station::create($lines)->mix('FUEL', 1);
$ore = $station->storage->get('ORE');
printf("ORE requiered: %d\n", $ore * -1); // 97422
