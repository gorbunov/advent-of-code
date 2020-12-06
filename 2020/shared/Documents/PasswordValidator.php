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

            if (!self::validateField($passport->getProperty($fieldname))) {
                return false;
            }
        }
        return true;
    }

    public static function validateField(PassportProperty $property): bool
    {
        $name = $property->getName();
        $value = $property->getValue();
        $validateHeight = static function ($value) {
            if (preg_match("~(?'height'\d+)(?'units'in|cm)~", $value, $matches) !== 0) {
                $height = (int)$matches['height'];
                return match ($matches['units']) {
                    'cm' => ($height >= 150) && ($height <= 193),
                    'in' => ($height >= 59) && ($height <= 76),
                };
            }
            return false;
        };
        return match ($name) {
            'cid' => true,
            'byr' => ((int)$value >= 1920) && ((int)$value <= 2002),
            'iyr' => ((int)$value >= 2010) && ((int)$value <= 2020),
            'eyr' => ((int)$value >= 2020) && ((int)$value <= 2030),
            'hgt' => $validateHeight($value),
            'hcl' => (preg_match("~^#[0-9a-f]{6}$~", $value) !== 0),
            'ecl' => in_array($value, ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'], true),
            'pid' => (preg_match('~^\d{9}$~', $value) !== 0)
        };
    }
}
