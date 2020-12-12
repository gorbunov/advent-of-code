<?php declare(strict_types=1);

namespace Utils;

final class Arr
{
    public static function without(array $array, int $index): array
    {
        return array_splice($array, $index, 1);
    }
}
