<?php declare(strict_types=1);


namespace Math;


final class Permutator
{
    public static function permute(array $input): array
    {
        $input = array_values($input);

        // permutation of 1 value is the same value
        if (\count($input) === 1) {
            return [$input];
        }

        // to permute multiple values, pick a value to put in the front and
        // permute the rest; repeat this with all values of the original array
        $result = [];
        for ($i = 0, $iMax = \count($input); $i < $iMax; $i++) {
            $copy = $input;
            $value = array_splice($copy, $i, 1);
            foreach (self::permute($copy) as $permutation) {
                array_unshift($permutation, $value[0]);
                $result[] = $permutation;
            }
        }

        return $result;
    }

    public static function cartesian_product_combinations(array $arrays, int $i = null): array
    {
        if ($i === null) {
            $i = 0;
        }
        if (!isset($arrays[$i])) {
            return [];
        }
        if ($i === \count($arrays) - 1) {
            return $arrays[$i];
        }

        // get combinations from subsequent arrays
        $tmp = self::cartesian_product_combinations($arrays, $i + 1);

        $result = [];

        // concat each array from tmp with each element from $arrays[$i]
        foreach ($arrays[$i] as $v) {
            foreach ($tmp as $t) {
                $result[] = \is_array($t) ?
                    array_merge([$v], $t) :
                    [$v, $t];
            }
        }

        return $result;
    }
}
