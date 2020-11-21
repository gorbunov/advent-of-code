<?php declare(strict_types=1);


namespace Navigation;


use Math\Permutator;

final class RouteMap
{
    /** @var array|Location[] */
    private array $locations = [];

    public function getShortestDistance(): int
    {
        return min(...array_values($this->getAlldistances()));
    }

    public function getAlldistances(): array
    {
        $distances = [];
        foreach ($this->getLocationsPermutations() as $route) {
            $distances[$this->getRouteName($route)] = $this->calculateRouteDistance($route);
        }
        return $distances;
    }

    public function getLocationsPermutations(): array
    {
        return Permutator::permute($this->getLocations());
    }


    public function getLocations(): array
    {
        return $this->locations;
    }

    private function getRouteName(array $locations): string
    {
        $navpoints = array_map(
            static function (Location $location) {
                return $location->getName();
            },
            $locations
        );
        return implode(' -> ', $navpoints);
    }

    /**
     * @param array|Location[] $locations
     *
     * @return int
     */
    private function calculateRouteDistance(array $locations): int
    {
        $distance = 0;
        for ($i = 1, $iMax = \count($locations); $i < $iMax; $i++) {
            $from = $locations[$i - 1];
            $from = $this->getLocation($from->getName());
            $to = $locations[$i];
            $to = $this->getLocation($to->getName());
            $distance += $from->getRouteTo($to->getName())->getDistance();
        }

        return $distance;
    }

    public function getLocation(string $name)
    {
        if (!isset($this->locations[$name])) {
            $this->locations[$name] = new Location($name);
        }
        return $this->locations[$name];
    }

    public function getLongestDistance(): int
    {
        return max(...array_values($this->getAlldistances()));
    }

    public function addRoute(NavRoute $route)
    {
        $locationFrom = $this->getLocation($route->getFrom());
        $locationTo = $this->getLocation($route->getTo());
        $locationFrom->addRoute($route);
        $locationTo->addRoute($route->reverse());
    }

    public function getRoutingsCount(): int
    {
        return gmp_intval((gmp_fact($this->getLocationsCount())) / gmp_fact($this->getLocationsCount() - $this->getRoutesCount()));
    }

    public function getLocationsCount(): int
    {
        return \count($this->locations);
    }

    public function getRoutesCount(): int
    {
        return \count($this->locations) - 1;
    }
}
