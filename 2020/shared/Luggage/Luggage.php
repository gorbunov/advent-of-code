<?php declare(strict_types=1);


namespace Luggage;


final class Luggage
{
    /** @var LuggageBag[] */
    private $bags = [];

    public static function fill(array $rules): Luggage
    {
        $luggage = new self();
        foreach ($rules as $rule) {
            preg_match("~^(?'color'.*) bags contain (?'ruleset'.*).$~", $rule, $matches);
            $bag = $luggage->getBag($matches['color']);
            if ($matches['ruleset'] === 'no other bags') { // bag has no rules
                continue;
            }
            preg_match_all("~(?'count'\d+) (?'color'.*) bag(?>s?)~U", $matches['ruleset'], $rulematches, PREG_SET_ORDER);
            foreach ($rulematches as $subrule) {
                $forBag = $luggage->getBag($subrule['color']);
                $bag->addRule(new LuggageRule($forBag, (int)$subrule['count']));
            }
        }

        return $luggage;
    }

    public function getBag(string $name): LuggageBag
    {
        if (!\array_key_exists($name, $this->bags)) {
            $this->bags[$name] = LuggageBag::create($name);
        }
        return $this->bags[$name];
    }

    public function canContain(string $color, int $count = 1)
    {
        $searchFor = $this->getBag($color);
        return array_filter($this->getBags(), fn($bag) => $bag->canContain($searchFor, $count));
    }

    /**
     * @return LuggageBag[]
     */
    public function getBags(): array
    {
        return $this->bags;
    }

    public function countNestedBags(string $color): int
    {
        return $this->getBag($color)->containsCount();
    }
}
