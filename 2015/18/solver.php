<?php declare(strict_types=1);

use Christmas\LightsGrid;

require_once __DIR__.'/../shared/autoload.php';

$lights = file('./lightsgrid.txt', FILE_IGNORE_NEW_LINES);
/*$lights = [
    '.#.#.#',
    '...##.',
    '#....#',
    '..#...',
    '#.#..#',
    '####..',
];*/
$lights = array_map(
    static function (string $row) {
        return str_split($row, 1);
    },
    $lights
);
$size = count($lights);
$grid = LightsGrid::create($size, $size);

foreach ($lights as $x => $row) {
    foreach ($row as $y => $light) {
        $state = $light === '#' ? LightsGrid::LIGHT_ON : LightsGrid::LIGHT_OFF;
        $grid->setLight($x, $y, $state);
    }
}

function calculate_step(LightsGrid $grid, int $size)
{
    $buffer = LightsGrid::create($size, $size);
    for ($x = 0; $x < $size; $x++) {
        for ($y = 0; $y < $size; $y++) {
            $buffer->setLight($x, $y, $grid->getStateChange($x, $y));
        }
    }
    return $buffer;
}

function force_on_corners(LightsGrid $grid, int $size)
{
    $grid->setLightOn(0, 0);
    $grid->setLightOn(0, $size - 1);
    $grid->setLightOn($size - 1, 0);
    $grid->setLightOn($size - 1, $size - 1);
}

//$grid->printState();
force_on_corners($grid, $size);
for ($step = 1; $step <= 100; $step++) {
    $grid = calculate_step($grid, $size);
    force_on_corners($grid, $size);
    //printf("Step: %d\n", $step);
    //$grid->printState();
}

printf("Lights now on: %d\n", $grid->countPoweredLights());


