<?php declare(strict_types=1);


namespace Orbiting;


final class OrbitMap
{
    private function __construct(array $orbits)
    {
    }

    public static function createFromMap(array $map): self
    {
        $orbits = [];
        foreach ($map as $record) {
            $orbits[] = $record;
        }
        return new self($orbits);
    }

    private static function parseOrbitRecord(string $record): array
    {
        return explode(')', $record);
    }
}
