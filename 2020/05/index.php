<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$passes = file('./boarding-passes.txt', FILE_IGNORE_NEW_LINES);
/** @var \Boarding\BoardingPass[] $passes */
$passes = array_map([\Boarding\BoardingPass::class, 'parse'], $passes);

$seatIds = array_map(fn($pass) => $pass->getSeatId(), $passes);

$max = array_reduce($seatIds, 'max', 0);

printf("Maximum seat Id: %d\n", $max);

sort($seatIds, SORT_NUMERIC | SORT_DESC);
for ($i = 1; $i < count($seatIds) - 1; $i++) {
    if ($seatIds[$i] - $seatIds[$i - 1] !== 1) {
        printf("Empty seat at: %d\n", $seatIds[$i] - 1);
        break;
    }
}
