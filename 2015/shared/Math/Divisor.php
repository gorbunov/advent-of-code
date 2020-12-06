<?php declare(strict_types=1);

namespace Math;

final class Divisor
{
    public static function findSumOfDivisors(int $n): int
    {
        $sum = 1;
        for ($i = 2; $i <= sqrt($n); $i++) {
            if ($n % $i === 0) {
                if ((int)($n / $i) === $i) {
                    $sum += $i;
                } else {
                    $sum += ($i + ($n / $i));
                }
            }
        }
        return $sum;
    }

    public static function findHighestDivisor(int $n): int
    {
        for ($i = ($n - 1); $i > 1; $i--) {
            if ($n % $i === 0) {
                return $i;
            }
        }
        return $n;
    }
}
