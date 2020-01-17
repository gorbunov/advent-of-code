<?php declare(strict_types=1);


namespace Orbiting;


final class OrbitMap
{
    /**
     * @var Body[]
     */
    private $bodies;

    /**
     * @var Body
     */
    private $com;

    private function __construct(array $orbits)
    {
        foreach ($orbits as [$parent, $body]) {
            $parent = $this->bodyReference($parent);
            $body = $this->bodyReference($body);
            $parent->orbitedBy($body);
            $body->orbitsAround($parent);
        }
        $this->com = $this->bodyReference('COM');
    }

    public function bodyReference(string $name): Body
    {
        if (!isset($this->bodies[$name])) {
            $this->bodies[$name] = Body::create($name);
        }
        return $this->bodies[$name];
    }

    public static function createFromMap(array $map): self
    {
        $orbits = [];
        foreach ($map as $record) {
            $orbits[] = self::parseOrbitRecord($record);
        }
        return new self($orbits);
    }

    private static function parseOrbitRecord(string $record): array
    {
        return explode(')', $record);
    }

    public function orbitsCount(): int
    {
        return $this->COM()->orbitsCount(0);
    }

    public function COM(): Body
    {
        return $this->com;
    }

    public function getBranch(string $name, string $to): array
    {
        $branch = [];
        $body = $this->bodyReference($name);
        while (!$body->is($to)) {
            $body = $body->parent();
            $branch[] = $body;
        }

        return $branch;
    }

    public function getIntersection(string $from, string $to): string
    {
        $branch1 = $this->getBranch($from, 'COM');
        $branch2 = $this->getBranch($to, 'COM');
        $intersection = array_intersect($branch1, $branch2);
        $intersection = array_shift($intersection);
        return $intersection->name();
    }

    public function getPath(string $from, string $to): array
    {
        $intersection = $this->getIntersection($from, $to);
        $path = [];
        $branch = $this->getBranch($from, $intersection);
        array_shift($path);
        $branch2 = $this->getBranch($to, $intersection);
        $path = array_unique(array_merge($branch, array_reverse($branch2)));
        return $path;
    }
}
