<?php declare(strict_types=1);

// reading test data
$modules = file('./modules.txt', FILE_IGNORE_NEW_LINES);

// typecasting to int
$modules = array_map('\intval', $modules);

/**
 * Takes mass and returns required fuel for that
 *
 * @param int $mass
 *
 * @return int
 */
function fuel_requirement(int $mass): int
{
    return abs((int)floor($mass / 3) - 2);
}

function total_fuel_requirement(int $mass): int
{
    $fuel_requirement = 0;
    $minimal_free_weight = 8; // (|floor(8/3)| - 2) = 0
    $requirement = $mass;
    while ($requirement > $minimal_free_weight) {
        $requirement = fuel_requirement($requirement);
        $fuel_requirement += $requirement;
    }
    return $fuel_requirement;
}

// some functional style php
$modules_fuel_required = array_reduce(
    $modules,
    static function (int $carry, int $module_weight): int {
        return $carry + total_fuel_requirement($module_weight);
    },
    0
);

printf("Fuel requirement: $modules_fuel_required\n");
