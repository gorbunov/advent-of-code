<?php declare(strict_types=1);

use WireGrid\Line;
use WireGrid\Position;

require_once __DIR__.'/../../shared/autoload.php';


$fixtures = [
    [[[0, 0], [0, 10]], [[0, 10], [10, 10]]],  // touches at 0,10
    [[[2, 1], [2, 6]], [[1, 4], [6, 4]]],  // touches at 2,4
    [[[2, 1], [2, 2]], [[3, 4], [3, 8]]], // false
    [ [[8,0], [8,5]] , [[0,7],[6,7]] ]  // false

];



$fixtures = [
//    [[[8, 5] , [3, 5]] , [[6, 7], [6, 3]]] //
    [[[3, 5] , [8, 5]] , [[6, 3], [6, 7]]],
    [ [ [3,2],[3,5] ], [ [2,3],[6,3] ] ]
];



foreach ($fixtures as [$p0, $p1]) {
    [$p0s, $p0e] = $p0;
    [$p1s, $p1e] = $p1;
    $line1 = Line::createFromPoints(Position::create(...$p0s), Position::create(...$p0e));
    $line2 = Line::createFromPoints(Position::create(...$p1s), Position::create(...$p1e));
    var_dump((string)$line1, (string)$line2, $line1->intersects($line2), (string)$line1->intersection($line2));
}
