<?php declare(strict_types=1);
require_once __DIR__.'/../../shared/autoload.php';
$fixtures = [
    1 => 31,
    2 => 165,
    3 => 13312,
    4 => 180697,
    5 => 2210736,
];

foreach ($fixtures as $caseId => $expected) {
    $lines = file(sprintf('./testcase01_%02d.txt', $caseId), FILE_IGNORE_NEW_LINES);
    $station = \Chemistry\Station::create($lines)->mix('FUEL', 1);
    $ore = $station->storage->get('ORE');
    assert($expected === $ore * -1);
}
