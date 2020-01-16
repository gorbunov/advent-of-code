<?php declare(strict_types=1);


namespace Validator\Rules;

final class DigitsIncrease implements Validation
{
    private static function toDigits(int $value): array
    {
        return str_split((string)$value, 1);
    }

    public function validate(int $value): bool
    {
        $digits = self::toDigits($value);
        for ($pos = 1, $digitsCount = count($digits); $pos < $digitsCount; $pos++) {
            if ((int)$digits[$pos - 1] > (int)$digits[$pos]) {
                return false;
            }
        }
        return true;
    }

    public static function create(): self {
        return new self();
    }
}
