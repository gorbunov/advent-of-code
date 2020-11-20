<?php declare(strict_types=1);

final class CityHouses
{
    private array $visits;

    public function __construct()
    {
        $this->visits = [];
    }

    public function visit(Position2D $position2D): self
    {
        // printf("visits %d:%d\n", $position2D->getX(), $position2D->getY());
        return $this->addVisit($position2D->getX(), $position2D->getY());
    }

    private function addVisit(int $x, int $y): self
    {
        if (!isset($this->visits[$x])) {
            $this->visits[$x] = [];
        }
        if (!isset($this->visits[$x][$y])) {
            $this->visits[$x][$y] = 0;
        }
        $this->visits[$x][$y]++;
        return $this;
    }

    public function getTotalVisits(): int
    {
        $total = 0;
        foreach ($this->visits as $row) {
            $total += array_sum($row);
        }
        return $total;
    }

    public function getVisitedHousesCount(): int
    {
        $total = 0;
        foreach ($this->visits as $row) {
            $total += count($row);
        }
        return $total;
    }

}
