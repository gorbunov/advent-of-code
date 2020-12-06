<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

function presents_count(int $house): int
{
    if ($house === 1) {
        return $house * 10;
    }
    return (\Math\Divisor::findSumOfDivisors($house) + $house) * 10;
}

$house = 3310000;
while (true && $house > 1) {
    if (presents_count($house) === 33100000) {
        printf("House: %d\n", $house);
        //break;
    }
    $house--;
}

printf("House: %d\n", $house);
/*for ($i = 1; $i < 10; $i++) {
    printf("%d\n", presents_count($i));
}

printf(\Math\Divisor::findHighestDivisor(3310000));*/
//printf(\Math\Divisor::findSumOfDivisors(7));
/*for ($i = 1; $i < PHP_INT_MAX;) {
    $sum = \Math\Divisor::findSumOfDivisors($i);
    if ($sum) {
        printf();
    }
}*/
