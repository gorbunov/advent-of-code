<?php declare(strict_types=1);


namespace SantaList;


final class StringUtils
{
    public static function getVowelsCount(string $line): int
    {
        $vowels = ['a', 'e', 'i', 'o', 'u'];
        $letters = self::countLetters($line);
        return array_sum(
            array_filter(
                $letters,
                static function ($count, $letter) use ($vowels) {
                    return \in_array($letter, $vowels, true);
                },
                ARRAY_FILTER_USE_BOTH
            )
        );
    }

    public static function countLetters(string $line): array
    {
        $letters = self::split($line);
        return array_count_values($letters);
    }

    public static function split(string $line): array
    {
        return str_split($line, 1);
    }

    public static function hasPairedLetters(string $line): bool
    {
        $letters = self::split($line);
        for ($i = 1, $iMax = \count($letters); $i < $iMax; $i++) {
            if ($letters[$i - 1] === $letters[$i]) {
                return true;
            }
        }
        return false;
    }

    public static function hasForbiddenSubstrings(string $line, array $substrings): bool
    {
        foreach ($substrings as $substring) {
            if (strpos($line, $substring) !== false) {
                return true;
            }
        }
        return false;
    }
}
