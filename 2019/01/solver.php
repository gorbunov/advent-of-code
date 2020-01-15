<?php declare(strict_types=1);

// reading test data
$modules = file('./modules.txt', FILE_IGNORE_NEW_LINES);

// typecasting to int
$modules = array_map('\intval', $modules);

// some functional style php
$fuel_required = array_reduce(
    $modules,
    static function (int $carry, int $module_weight): int {
        return $carry + abs((int)floor($module_weight / 3) - 2);
    },
    0
);

printf("Fuel required: $fuel_required\n");
