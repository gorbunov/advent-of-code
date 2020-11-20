<?php declare(strict_types=1);

namespace SantaList;

final class NicenessValidator
{
    /** @var array|callable[] */
    private array $rules = [];

    private function __construct(array $ruleset)
    {
        $this->rules = $ruleset;
    }

    /**
     * @param array|callable[] $ruleset
     *
     * @return NicenessValidator
     */
    public static function create(array $ruleset): NicenessValidator
    {
        return new self($ruleset);
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
