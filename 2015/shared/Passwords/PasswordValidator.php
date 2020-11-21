<?php declare(strict_types=1);


namespace Passwords;


use SantaList\StringUtils;

final class PasswordValidator
{
    private string $password;

    public function __construct(string $password)
    {
        $this->password = $password;
    }

    public static function isValid(string $password): bool
    {
        return (new self($password))->validate();
    }

    public function validate(): bool
    {
        foreach ($this->getRuleset() as $rule) {
            if (!$rule($this->password)) {
                return false;
            }
        }
        return true;
    }

    /**
     * @return array|callable[]
     */
    private function getRuleset(): array
    {
        return [
            // has forbidden letters
            static function ($password) {
                $letters = str_split($password, 1);
                return \count(array_intersect($letters, ['i', 'l', 'o'])) === 0;
            },
            // has straight
            static function ($password) {
                $letters = str_split($password);
                for ($i = 0; $i < \count($letters) - 2; $i++) {
                    $firstLetterCode = \ord($letters[$i]);
                    if ($firstLetterCode === (\ord($letters[$i + 1]) - 1) &&
                        $firstLetterCode === (\ord($letters[$i + 2]) - 2)) {
                        // found straight
                        return true;
                    }
                }
                return false;
            },
            // has more than 1 pair
            static function ($password) {
                $letters = str_split($password);
                $foundPairs = [];
                for ($i = 1, $iMax = \count($letters); $i < $iMax; $i++) {
                    if ($letters[$i - 1] === $letters[$i]) {
                        $pair = $letters[$i - 1].$letters[$i];
                        if (!\in_array($pair, $foundPairs, true)) {
                            $foundPairs[] = $pair;
                        }
                    }
                }
                return \count($foundPairs) > 1;
            },
        ];
    }
}
