<?php declare(strict_types=1);

namespace WireGrid;

final class Wire
{
    /**
     * @var Position[]
     */
    private $points;
    /**
     * @var  Direction[]
     */
    private $definition;

    public static function createFromString(string $definition): self
    {
        $directions = array_map(
            static function (string $direction) {
                return Direction::fromString($direction);
            },
            explode(',', $definition)
        );
        return new self($directions);
    }

    /**
     * Wire constructor.
     *
     * @param Direction[] $definition
     */
    private function __construct(array $definition)
    {
        $this->definition = $definition;
        $this->points = $this->getAllPoints();

        var_dump($this->points);
    }

    private function findNextPosition(Position $start, Direction $direction): Position
    {
        return $start->apply($direction);
    }

    /**
     * @return Position[]
     */
    private function getAllPoints(): array
    {
        $current = $this->startPosition();
        $points = [$current];
        foreach ($this->definition as $direction) {
            $point = $this->findNextPosition($current, $direction);
            $points[] = $point;
            $current = $point;
        }
        return $points;
    }

    private function startPosition(): Position
    {
        return Position::create(0, 0);
    }

    /**
     * @return Line[]
     */
    public function lines(): array
    {
        $lines = [];
        for ($i = 0, $iMax = count($this->points) - 1; $i < $iMax; $i++) {
            $lines = Line::createFromPoints($this->points[$i], $this->points[$i + 1]);
        }

        return $lines;
    }
}
