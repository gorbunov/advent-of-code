<?php declare(strict_types=1);

namespace WireGrid;

final class Line
{
    /**
     * @var Position
     */
    private $start;
    /**
     * @var Position
     */
    private $end;

    private function __construct(Position $start, Position $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    private function getXs(): array
    {
        return [$this->start->x(), $this->end->x()];
    }

    private function getYs(): array
    {
        return [$this->start->y(), $this->end->y()];
    }

    public function minX(): int
    {
        return min(...$this->getXs());
    }


    public function maxX(): int
    {
        return max(...$this->getXs());
    }

    public function minY(): int
    {
        return min(...$this->getYs());
    }

    public function maxY(): int
    {
        return max(...$this->getYs());
    }

    public static function createFromPoints(Position $start, Position $end): Line
    {
        return new self($start, $end);
    }

    public function intersects(Line $line): bool
    {
    }

    public function intersection(Line $line): Position
    {
    }
}
