<?php declare(strict_types=1);
$modules = array_map('\intval', file('./modules.txt', FILE_IGNORE_NEW_LINES));

/**
 * Takes mass and returns required fuel for that
 *
 * @param int $mass
 *
 * @return int
 */
$fuel_requirement_func = static function (int $mass): int {
    return abs((int)floor($mass / 3) - 2);
};

$total_fuel_requirement = static function (int $mass) use ($fuel_requirement_func): int {
    $fuel_requirement = 0;
    $minimal_free_weight = 8; // (|floor(8/3)| - 2) = 0
    $requirement = $mass;
    while ($requirement > $minimal_free_weight) {
        $requirement = $fuel_requirement_func($requirement);
        $fuel_requirement += $requirement;
    }
    return $fuel_requirement;
};

$requirement_calculator = static function ($modules, callable $calculator_func) {
    return array_reduce(
        $modules,
        static function (int $carry, int $module_weight) use ($calculator_func): int {
            return $carry + $calculator_func($module_weight);
        },
        0
    );
};

printf("Only modules fuel requirement: %d\n", $requirement_calculator($modules, $fuel_requirement_func));
printf("Fuel total requirement: %d\n", $requirement_calculator($modules, $total_fuel_requirement));
