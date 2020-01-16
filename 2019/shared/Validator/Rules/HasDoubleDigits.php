<?php declare(strict_types=1);

namespace Validator\Rules;

final class HasDoubleDigits implements Validation
{
    public function validate(int $value): bool
    {
        $digits = str_split((string)$value, 1);
        for ($pos = 1, $digitsCount = count($digits); $pos < $digitsCount; $pos++) {
            if ($digits[$pos] === $digits[$pos - 1]) {
                return true;
            }
        }
        return false;
    }

    public static function create(): self
    {
        return new self();
    }
}
