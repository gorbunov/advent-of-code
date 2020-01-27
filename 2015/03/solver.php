<?php declare(strict_types=1);
$directions = str_split(trim(file_get_contents('./directions.txt')), 1);
$locations = [];
$x = 0;
$y = 0;
$locations[0][0] = 1;
foreach ($directions as $direction) {
    switch ($direction) {
        case '^':
            $y++;
            break;
        case 'v':
            $y--;
            break;
        case '<':
            $x--;
            break;
        case '>':
            $x++;
            break;
    }
    if (!isset($locations[$x][$y])) {
        $locations[$x][$y] = 0;
    }
    $locations[$x][$y]++;
}
$carry = 0;
foreach ($locations as $x) {
    $carry += count($x);
}
printf("Houses visited: %d\n", $carry);
