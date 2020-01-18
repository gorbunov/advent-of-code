<?php declare(strict_types=1);

namespace Validator\Rules;

use function in_array;

final class ExactlyDoubleDigitsGroupExists implements Validation
{

    public function validate(int $value): bool
    {
        $digits = str_split((string)$value, 1);
        $groups = self::group($digits);
        return in_array(2, $groups, true);
    }


    public static function create(): self
    {
        return new self();
    }

    private static function group(array $digits): array
    {
        $grouped = [];
        $current = null;
        foreach ($digits as $digit) {
            if ($current !== $digit) {
                $current = $digit;
            }
            if (!isset($grouped[$current])) {
                $grouped[$current] = 0;
            }
            ++$grouped[$current];
        }

        return $grouped;
    }
}
