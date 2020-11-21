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
        for ($i = 0, $iMax = count($input); $i < $iMax; $i++) {
            $copy = $input;
            $value = array_splice($copy, $i, 1);
            foreach (self::permute($copy) as $permutation) {
                array_unshift($permutation, $value[0]);
                $result[] = $permutation;
            }
        }

        return $result;
    }
}
