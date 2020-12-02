<?php declare(strict_types=1);


namespace Passwords;


final class Policy
{
    /**
     * @var string
     */
    private $letter;
    /**
     * @var int
     */
    private $minQuantity;
    /**
     * @var int
     */
    private $maxQuantity;

    public function __construct(string $letter, int $minQuantity, int $maxQuantity)
    {
        $this->letter = $letter;
        $this->minQuantity = $minQuantity;
        $this->maxQuantity = $maxQuantity;
    }

    public static function parse(string $def): Policy
    {
        preg_match("~(?'min'\d+)-(?'max'\d+) (?'letter'\w)~", $def, $matches);
        return new self($matches['letter'], (int)$matches['min'], (int)$matches['max']);
    }

    public function isValid(string $password): bool
    {
        $appearenceCount = substr_count($password, $this->letter);
        return (($appearenceCount >= $this->minQuantity) and ($appearenceCount <= $this->maxQuantity));
    }

    public function isValidPositionally(string $password): bool
    {
        $pos1 = ($password[$this->minQuantity - 1] === $this->letter);
        $pos2 = ($password[$this->maxQuantity - 1] === $this->letter);

        return $pos1 xor $pos2;
    }
}
