<?php declare(strict_types=1);


namespace Math;


final class Combinator
{
    public static function combinations(array $set, int $samplingSize, bool $allowRepetitions = false)
    {
        foreach ($set as $item) {
            if ($samplingSize === 1) {
                yield [$item];
            } else {
                $subset = $allowRepetitions ? $set : array_diff($set, [$item]);
                foreach (self::combinations($subset, $samplingSize - 1, $allowRepetitions) as $combo) {
                    $combo[] = $item;
                    yield $combo;
                }
            }
        }
    }
}
