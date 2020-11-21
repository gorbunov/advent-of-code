<?php declare(strict_types=1);


namespace Guests;


use Math\Permutator;

final class RelationsList
{
    /** @var array|Guest[] */
    private $guests;

    public function __construct()
    {
        $this->guests = [];
    }

    public function parse(string $line): void
    {
        preg_match("~^(?'guest1'\w+) would (?'change'\w+) (?'amount'\d+) happiness units by sitting next to (?'guest2'\w+).$~", $line, $matches);
        $amount = (int)$matches['amount'];
        $amount = $matches['change'] === 'gain' ? $amount : $amount * -1;
        $relation = Relation::create($matches['guest2'], $amount);
        $this->getGuest($matches['guest1'])->addRelation($matches['guest2'], $relation);
    }

    public function getGuest(string $name)
    {
        if (!isset($this->guests[$name])) {
            $this->guests[$name] = Guest::create($name);
        }
        return $this->guests[$name];
    }

    /**
     * @return array|Seating[]
     */
    public function getSeatings(): array
    {
        $options = Permutator::permute($this->guests);
        return array_map(
            static function ($seating) {
                return Seating::create($seating);
            },
            $options
        );
    }
}
