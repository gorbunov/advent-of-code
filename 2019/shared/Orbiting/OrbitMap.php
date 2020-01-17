<?php declare(strict_types=1);


namespace Orbiting;


final class OrbitMap
{
    /**
     * @var Body[]
     */
    private $bodies;
    /**
     * @var Body[]
     */
    private $orbits;

    private function __construct(array $orbits)
    {
        foreach ($orbits as [$parent, $body]) {
            $parent = $this->bodyReference($parent);
            $body = $this->bodyReference($body);
            $parent->orbitedBy($body);
        }
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
}
