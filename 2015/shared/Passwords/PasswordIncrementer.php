<?php declare(strict_types=1);


namespace Passwords;


final class PasswordIncrementer
{
    private string $password;

    public function __construct(string $password)
    {
        $this->password = $password;
    }

    public static function next(string $password): string
    {
        return (new self($password))->getNext();
    }

    public function getNext(): string
    {
        return $this->iterate()->getPassword();
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function iterate(): self
    {
        $letters = str_split($this->password, 1);
        for ($i = \count($letters) - 1; $i >= 0; $i--) {
            $current = $letters[$i];
            $letters[$i] = $this->nextLetter($current);
            if (!$this->willOverflow($current)) {
                break;
            }
        }
        $this->password = implode($letters);
        return $this;
    }

    private function nextLetter(string $letter): string
    {
        $code = \ord($letter) + 1;
        if ($code > 122) {
            $code = 97;
        }
        return \chr($code);
    }

    private function willOverflow(string $letter): bool
    {
        $code = \ord($letter) + 1;
        return $code > 122;
    }

}
