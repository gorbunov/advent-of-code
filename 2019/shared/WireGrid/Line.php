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
    /**
     * @var int
     */
    private $length;

    private function __construct(Position $start, Position $end)
    {
        $this->start = $start;
        $this->end = $end;
        $this->length = abs($this->end->x() - $this->start->x()) + abs($this->end->y() - $this->start->y());
    }

    private function minX(): int
    {
        return min($this->start->x(), $this->end->x());
    }

    private function minY(): int
    {
        return min($this->start->y(), $this->end->y());
    }

    private function maxX(): int
    {
        return max($this->start->x(), $this->end->x());
    }

    private function maxY(): int
    {
        return max($this->start->y(), $this->end->y());
    }

    public static function createFromPoints(Position $start, Position $end): Line
    {
        return new self($start, $end);
    }

    public function intersects(Line $line): bool
    {
        if ($this->touches($line)) {
            return true;
        }

        if ($this->is_parallel($line)) {
            return false;
        }

        $intersection = $this->intersects_at($line);
        return $this->has_point($intersection) && $line->has_point($intersection);
    }

    private function touches(Line $line): bool
    {
        /** @var Position $endpoint */
        foreach ([$this->start, $this->end] as $endpoint) {
            /** @var Position $endpoint2 */
            foreach ([$line->getStart(), $line->getEnd()] as $endpoint2) {
                if ($endpoint->equals($endpoint2)) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @return Position
     */
    public function getStart(): Position
    {
        return $this->start;
    }

    /**
     * @return Position
     */
    public function getEnd(): Position
    {
        return $this->end;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }

    private function is_parallel(Line $line): bool
    {
        return $this->is_horizontal() === $line->is_horizontal();
    }

    private function is_horizontal(): bool
    {
        return $this->start->y() === $this->end->y();
    }

    public function intersection(Line $line): ?Position
    {
        if ($this->touches($line)) {
            return $this->touches_at($line);
        }

        if ($this->is_parallel($line)) {
            return null;
        }

        $intersection = $this->intersects_at($line);
        if ($this->has_point($intersection) && $line->has_point($intersection)) {
            return $intersection;
        }

        return null;
    }

    private function touches_at(Line $line): ?Position
    {
        /** @var Position $endpoint */
        foreach ([$this->start, $this->end] as $endpoint) {
            /** @var Position $endpoint2 */
            foreach ([$line->getStart(), $line->getEnd()] as $endpoint2) {
                if ($endpoint->equals($endpoint2)) {
                    return $endpoint;
                }
            }
        }
        return null;
    }

    private function intersects_at(Line $line): Position
    {
        $x = $this->is_horizontal()?$line->getStart()->x():$this->start->x();
        $y = $this->is_horizontal()?$this->start->y():$line->getStart()->y();
        return Position::create($x, $y);
    }

    public function has_point(Position $position): bool
    {
        $on_x = $this->minX() <= $position->x() && $this->maxX() >= $position->x();
        $on_y = $this->minY() <= $position->y() && $this->maxY() >= $position->y();
        //echo (string)$position, (string)$this, ':', $on_x,':', $on_y, "\n";
        return $on_x && $on_y;
    }

    public function distance_to_position(Position $position): int
    {
        //var_dump('ps',(string)$position, (string)$this);
        return abs(($position->x() - $this->start->x()) + ($position->y() - $this->start->y()));
    }

    public function __toString()
    {
        return $this->toString();
    }

    public function toString(): string
    {
        return implode(' - ', [(string)$this->start, (string)$this->end]) . ' L: '. $this->length;
    }
}
