<?php declare(strict_types=1);
$presents = file('./dimensions.txt', FILE_IGNORE_NEW_LINES);
$presents = array_map(
    static function ($line) {
        return array_map('\intval', explode('x', $line));
    },
    $presents
);
$request = 0;
$ribbon = 0;
foreach ($presents as [$w, $h, $l]) {
    $areas = [$w * $h, $h * $l, $l * $w];
    $slack = min(...$areas);
    $totals = array_sum($areas) * 2 + $slack;
    $request += $totals;
    $dims = [$w, $h, $l];
    sort($dims, SORT_DESC | SORT_NUMERIC);
    $bow = array_product($dims);
    array_pop($dims);
    $minimal = array_sum($dims) * 2;
    $ribbon += $bow + $minimal;
}

printf("We need %d meters of paper\n", $request); // 1598415
printf("We need %d meters of ribbon\n", $ribbon); // 3812909
