<?php declare(strict_types=1);

namespace SantaList;

final class NicenessValidator
{
    /** @var array|callable[] */
    private array $rules = [];

    private function __construct()
    {
        $this->rules = [
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

    public static function create(): NicenessValidator
    {
        return new self();
    }

    public function isNice(string $line): bool
    {
        $isNice = true;

        foreach ($this->rules as $rule) {
            $isNice = $isNice && $rule($line);
        }
        return $isNice;
    }

}
