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

        return true;
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

    private function is_parallel(Line $line): bool
    {
        return $this->is_horizontal() === $line->is_horizontal();
    }

    private function is_horizontal(): bool
    {
        return $this->start->x() === $this->end->x();
    }

    public function intersection(Line $line): ?Position
    {
        if ($this->touches($line)) {
            return $this->touches_at($line);
        }

        if ($this->is_parallel($line)) {
            return null;
        }

        return $this->intersects_at($line);
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
        $x = $this->is_horizontal() ? $this->start->x() : $line->getStart()->x();
        $y = $this->is_horizontal() ? $line->getStart()->y() : $this->start->y();
        return Position::create($x, $y);
    }

    public function __toString()
    {
        return $this->toString();
    }

    public function toString(): string
    {
        return implode(' - ', [(string)$this->start, (string)$this->end]);
    }
}
