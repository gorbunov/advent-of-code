<?php declare(strict_types=1);


namespace Luggage;


use JetBrains\PhpStorm\Pure;

final class LuggageBag
{
    private string $name;
    /** @var LuggageRule[] */
    private array $rules = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function create(string $name): LuggageBag
    {
        return new self($name);
    }

    public function addRule(LuggageRule $rule)
    {
        $this->rules[$rule->getForBag()->getName()] = $rule;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function canContain(LuggageBag $bag, int $count): bool
    {
        if ($this->canItselfHold($bag, $count)) {
            return true;
        }
        foreach ($this->rules as $rule) {
            //printf("Checking %s, can contain %s\n", $rule->getForBag()->getName(), $bag->getName());
            if ($rule->getForBag()->canContain($bag, $count)) {
                return true;
            }
        }
        return false;
    }

    private function canItselfHold(LuggageBag $bag, int $count)
    {
        if ($this->hasRuleForBag($bag)) {
            return ($this->rules[$bag->getName()]->getContainCount() >= $count);
        }
        return false;
    }

    public function hasRuleForBag(LuggageBag $bag): bool
    {
        return \array_key_exists($bag->getName(), $this->rules);
    }

    public function containsCount(): int
    {
        if (!$this->hasRules()) {
            return 0;
        }
        $total = 0;
        foreach ($this->rules as $rule) {
            $bagCount = $rule->getContainCount();
            $bag = $rule->getForBag();
            $insideBag = $bagCount * $bag->containsCount();
            $total += $bagCount + $insideBag;
        }
        return $total;
    }

    public function hasRules(): bool
    {
        return !empty($this->rules);
    }

}
