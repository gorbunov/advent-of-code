<?php declare(strict_types=1);

namespace Reindeers;

final class Leaderboard
{
    private $points;

    public function __construct()
    {
        $this->points = [];
    }

    public static function create()
    {
        return new self();
    }

    public function addPoint(string $name)
    {
        if (!isset($this->points[$name])) {
            $this->points[$name] = 0;
        }
        $this->points[$name]++;
    }
}
