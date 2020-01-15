<?php declare(strict_types=1);

use WireGrid\Line;
use WireGrid\Position;

require_once __DIR__.'/../../shared/autoload.php';

$fixtures = [
    [[[0, 0], [0, 10]], [[0, 10], [10, 10]]],
];

foreach ($fixtures as [$p0, $p1]) {
    [$p0s, $p0e] = $p0;
    [$p1s, $p1e] = $p1;
    $line1 = Line::createFromPoints(Position::create(...$p0s), Position::create(...$p0e));
    $line2 = Line::createFromPoints(Position::create(...$p1s), Position::create(...$p1e));
    var_dump($line1, $line2);
}
