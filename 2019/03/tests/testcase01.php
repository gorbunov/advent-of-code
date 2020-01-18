<?php declare(strict_types=1);

use WireGrid\Grid;

require_once __DIR__ . '/../../shared/autoload.php';
$fixtures = [
    6   => [
        'R8,U5,L5,D3',
        'U7,R6,D4,L4',
    ],
    159 => [
        'R75,D30,R83,U83,L12,D49,R71,U7,L72',
        'U62,R66,U55,R34,D71,R55,D58,R83',
    ],
    135 => [
        'R98,U47,R26,D63,R33,U87,L62,D20,R33,U53,R51',
        'U98,R91,D20,R16,D67,R40,U7,R15,U6,R7',
    ],
];

foreach ($fixtures as $expected => $wires) {
    $grid = Grid::createFromWires($wires);
    //var_dump(array_map(static function(\WireGrid\Position $position){ return (string)$position; },$grid->intersections()));
    //var_dump($grid->distances());
    printf("Closest distance: %d\n", $grid->closest());
}
