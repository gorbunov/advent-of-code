<?php declare(strict_types=1);

namespace WireGrid;

final class Grid
{
    /**
     * @var Position
     */
    private $centralPort;

    /**
     * @var array<Wire>
     */
    private $wires;

    public static function createFromWires(array $wires): self
    {
        $wires = array_map(
            static function (string $definition) {
                return Wire::createFromString($definition);
            },
            $wires
        );
        return new self($wires);
    }

    private function __construct(array $wires)
    {
        $this->centralPort = Position::create(0, 0);
        $this->wires = $wires;
    }

    /**
     * @return Position
     */
    public function getCentralPort(): Position
    {
        return $this->centralPort;
    }

    public function distanceFromCentralPort(Position $position): int
    {
        return $this->getCentralPort()->distance($position);
    }

    public function wires(): array
    {
        return $this->wires;
    }

}
