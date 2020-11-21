<?php declare(strict_types=1);


namespace Reindeers;


final class ReindeerList
{
    /** @var array|Reindeer[] */
    private array $reindeers;

    public function __construct()
    {
        $this->reindeers = [];
    }

    public static function create()
    {
        return new self();
    }

    public function parse(string $line)
    {
        preg_match("~^(?'name'\w+) can fly (?'speed'\d+) km/s for (?'flytime'\d+) seconds, but then must rest for (?'resstime'\d+) seconds.$~", $line, $matches);
        $reindeer = Reindeer::create($matches['name'], (int)$matches['speed'], (int)$matches['flytime'], (int)$matches['resstime']);
        $this->addReindeer($reindeer);
    }

    public function addReindeer(Reindeer $reindeer)
    {
        $this->reindeers[$reindeer->getName()] = $reindeer;
    }

    public function getReindeer(string $name): Reindeer
    {
        return $this->reindeers[$name];
    }

    public function traveledAfter(int $time): array
    {
        $laptime = [];
        foreach ($this->reindeers as $reindeer) {
            $laptime[$reindeer->getName()] = $reindeer->getDistanceAtTime($time);
        }

        return $laptime;
    }
}
