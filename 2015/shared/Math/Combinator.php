<?php declare(strict_types=1);


namespace Math;


final class Combinator
{
    /*    public static function combinations(array $set, int $samplingSize, bool $allowRepetitions = false): array
        {
            if ($samplingSize === 1) {
                return array_map(fn($item) => [$item], $set);
            }
            $combinations = [];
            foreach ($set as $idx => $element) {
                $subset = $allowRepetitions ? $set : array_diff($set, [$element]);
                $subcombos = self::combinations($subset, $samplingSize - 1, $allowRepetitions);
                foreach ($subcombos as $subcombo) {
                    $subcombo[] = $element;
                    $combinations[] = $subcombo;
                }
            }
            return $combinations;
        }*/

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

    /*
    public static function combinations(array $set, int $samplingSize, bool $allowRepetitions = false)
    {
        if ($samplingSize === 1) {
            return array_map(fn($item) => [$item], $set);
        }
        $found = [];
        foreach ($set as $ix => $item) {
            $subset = $set;
            if (!$allowRepetitions) {
                unset($subset[$ix]);
            }
            $deep = self::combinations($subset, $samplingSize - 1, $allowRepetitions);

            foreach ($deep as $subcombo) {
                $found[] = [$item, ...$subcombo];
            }
        }
        return $found;
    }*/
}
