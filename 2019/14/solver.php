<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$lines = file('./reactions.txt', FILE_IGNORE_NEW_LINES);
$station = \Chemistry\Station::create($lines)->mix('FUEL', 1);
$ore = $station->storage->get('ORE') * -1;
printf("ORE requiered: %d\n", $ore); // 97422

$ratio = $ore; // ORE amount to produce 1 FUEL

$availableOre = 1000000000000;

$approxMin = (int)floor($availableOre / $ratio);
$approxMax = $approxMin * 2;

$lastFit = 0;
do {
    printf("Ore reqirements range: %d - %d\n", $approxMin, $approxMax);
    $approx = (int)round(($approxMax + $approxMin) / 2);
    $station->reset();
    $station->mix('FUEL', $approx);
    $oreSpent = $station->storage->get('ORE') * -1;
    printf("Tried to mix %d FUEL, ORE spent: %d\n", $approx, $oreSpent);
    if ($oreSpent > $availableOre) {
        $approxMax = $approx - 1;
    } elseif ($oreSpent < $availableOre) {
        $lastFit = $approx;
        $approxMin = $approx;
    }
} while ($approxMax > $approxMin);

printf("Best fuel production: %d\n", $lastFit); // 13108426
