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

    /**
     * Wire constructor.
     *
     * @param Direction[] $definition
     */
    private function __construct(array $definition)
    {
        $this->definition = $definition;
        $this->points = $this->getAllPoints();
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

    private function findNextPosition(Position $start, Direction $direction): Position
    {
        return $start->apply($direction);
    }

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
     * @param Wire $wire
     *
     * @return Position[]
     */
    public function getIntersectionPoints(Wire $wire): array
    {
        $intersections = [];
        $lines = $this->lines();
        $lines2 = $wire->lines();
        foreach ($lines as $line) {
            foreach ($lines2 as $otherline) {
                //printf("matching %s with %s: ", $line, $otherline);
                if ($line->intersects($otherline)) {
                    //printf("%s × %s @ %s\n", $line, $otherline, $line->intersection($otherline));
                    $intersections[] = $line->intersection($otherline);
                } else {
                    //printf(" - no match\n");
                }
            }
        }
        return $intersections;
    }

    /**
     * @return Line[]
     */
    public function lines(): array
    {
        $lines = [];
        for ($i = 0, $iMax = \count($this->points) - 1; $i < $iMax; $i++) {
            $lines[] = Line::createFromPoints($this->points[$i], $this->points[$i + 1]);
        }

        return $lines;
    }

    public function stepsToPosition(Position $position): int
    {
        $distance = 0;
        $i = 0;
        foreach ($this->lines() as $line) {
            if ($line->has_point($position)) {
                $distance+= $line->distance_to_position($position);
                //printf("%d, %d\n",$line->distance_to_position($position), $distance);
                return $distance;
            }
            $distance += $line->getLength();
            //printf("%d: +%d = %d\n", $i++, $line->getLength(), $distance);
        }
        return $distance;
    }
}
