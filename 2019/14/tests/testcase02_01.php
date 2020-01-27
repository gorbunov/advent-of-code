<?php declare(strict_types=1);
require_once __DIR__.'/../../shared/autoload.php';
$fixtures = [
    3 => 82892753,
    4 => 5586022,
    5 => 460664,
];

foreach ($fixtures as $caseId => $expected) {
    $lines = file(sprintf('./testcase01_%02d.txt', $caseId), FILE_IGNORE_NEW_LINES);
    $station = \Chemistry\Station::create($lines);
    $station->storage()->store('ORE', 1000000000000);
    $station->produce('FUEL');
    $fuel = $station->storage()->get('FUEL');
    print($fuel);
    assert($expected === $fuel);
}
