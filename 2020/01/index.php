<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$expenses = array_map('\intval', file('./expenses.txt', FILE_IGNORE_NEW_LINES));

foreach ($expenses as $spending) {
    foreach ($expenses as $other) {
        foreach ($expenses as $third) {
            if (($spending + $other + $third) === 2020) {
                printf("Total: %d × %d × %d = %d\n", $spending, $other, $third, $spending * $other * $third);
                break 2;
            }
        }
    }
}
