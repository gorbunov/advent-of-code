<?php declare(strict_types=1);


namespace Guests;


final class Seating
{
    /** @var array|Guest[] */
    private array $order;

    public function __construct(array $order)
    {
        $this->order = $order;
    }

    public static function create(array $order): Seating
    {
        return new self($order);
    }

    public function getHappiness(): int
    {
        $happiness = 0;
        foreach ($this->order as $index => $seat) {
            $happiness += $this->getHappinessChange($index);
        }
        return $happiness;
    }

    public function getHappinessChange(int $index): int
    {
        $happiness = 0;
        $guest = $this->order[$index];
        /** @var array|Guest[] $neighbours */
        $neighbours = $this->getGuestNeighbours($index);
        foreach ($neighbours as $neighbour) {
            $change = $guest->getRelationTo($neighbour->getName())->getAmount();
            $happiness += $change;
            // printf("%s seat near %s, gets %d happiness.\n", $guest->getName(), $neighbour->getName(), $change);
        }
        return $happiness;
    }

    private function getGuestNeighbours(int $index): array
    {
        $prev = $index - 1;
        $next = $index + 1;
        if ($prev < 0) {
            $prev = \count($this->order) - 1;
        }
        if ($next === \count($this->order)) {
            $next = 0;
        }
        return [$this->order[$prev], $this->order[$next]];
    }
}
