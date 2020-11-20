<?php declare(strict_types=1);


namespace SantaList;


final class Ruleset02
{
    public static function getRules(): array
    {
        return [
            static function (string $line) {
                return StringUtils::hasPairedLettersSeparatedByLetter($line);
            },
            static function (string $line) {
                return \count(StringUtils::getPairedLetters($line)) > 0;
            },
        ];
    }
}
