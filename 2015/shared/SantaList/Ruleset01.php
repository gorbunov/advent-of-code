<?php declare(strict_types=1);


namespace SantaList;


final class Ruleset01
{
    public static function getRules()
    {
        return [
            // has 3+ vowels
            static function (string $line) {
                return StringUtils::getVowelsCount($line) >= 3;
            },
            // has pairs
            static function (string $line) {
                return StringUtils::hasPairedLetters($line);
            },
            // don't have naugthy letters
            static function (string $line) {
                $forbidden = ['ab', 'cd', 'pq', 'xy'];
                return !StringUtils::hasForbiddenSubstrings($line, $forbidden);
            },
        ];
    }
}
