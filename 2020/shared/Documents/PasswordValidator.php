<?php declare(strict_types=1);

namespace Documents;

final class PasswordValidator
{
    private static $required = [
        'byr',
        'iyr',
        'eyr',
        'hgt',
        'hcl',
        'ecl',
        'pid',
    ];

    public static function validate(Passport $passport): bool
    {
        foreach (self::$required as $fieldname) {
            if (!$passport->hasProperty($fieldname)) {
                return false;
            }
        }
        return true;
    }
}
