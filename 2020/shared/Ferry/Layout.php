<?php declare(strict_types=1);

namespace Ferry;

final class Layout
{
    public const SEAT = 'L';
    public const FLOOR = '.';
    public const TAKEN = '#';
    /** @var array[] */
    private array $seats;
    private int $sizeY;
    private int $sizeX;

    public function __construct(array $seats)
    {
        $this->seats = $seats;
        $this->sizeX = count($seats[0]);
        $this->sizeY = count($seats);
    }

    /**
     * @param array $rows
     *
     * @return Layout
     */
    public static function load(array $rows): Layout
    {
        return new self(array_map('str_split', $rows));
    }

    public function __toString(): string
    {
        return implode("\n", array_map(fn(array $row) => implode('', $row), $this->seats))."\n";
    }

    public function getAtPos(int $row, int $col): string
    {
        return $this->seats[$row][$col] ?? self::FLOOR;
    }

    public function setAtPos(int $row, int $col, string $what)
    {
        $this->seats[$row][$col] = $what;
    }

    /**
     * @return int
     */
    public function getSizeY(): int
    {
        return $this->sizeY;
    }

    /**
     * @return int
     */
    public function getSizeX(): int
    {
        return $this->sizeX;
    }

    public function getAjacentCount(int $row, int $col): int
    {
        $neighbours = [
            [-1, -1],
            [0, -1],
            [1, -1],
            [-1, 0], /*[0, 0],*/
            [1, 0],
            [-1, 1],
            [0, 1],
            [1, 1],
        ];
        $neighbours = array_map(fn(array $coords) => [$row + $coords[1], $col + $coords[0]], $neighbours);
        $statuses = array_map(fn(array $coords) => $this->getAtPos(...$coords), $neighbours);
        $seated = array_filter($statuses, fn($seat) => $seat === self::TAKEN);
        return count($seated);
    }

    public function seatPassengers(): int
    {
        $changed = 0;
        $buffer = clone $this;
        for ($row = 0; $row < $this->sizeY; $row++) {
            for ($col = 0; $col < $this->sizeX; $col++) {
                $seat = $this->getAtPos($row, $col);
                switch ($seat) {
                    case self::TAKEN:
                        if ($this->getAjacentCount($row, $col) > 3) {
                            $buffer->setAtPos($row, $col, self::SEAT);
                            $changed++;
                        }
                        break;
                    case self::SEAT:
                        if ($this->getAjacentCount($row, $col) === 0) {
                            $buffer->setAtPos($row, $col, self::TAKEN);
                            $changed++;
                        }
                        break;
                }
            }
        }
        $this->seats = $buffer->getSeats();
        return $changed;
    }

    /**
     * @return array[]
     */
    public function getSeats(): array
    {
        return $this->seats;
    }

    public function getSeatedCount(): int
    {
        $rows = array_map(fn(array $row) => array_filter($row, fn(string $seat) => $seat === self::TAKEN), $this->seats);
        return array_sum(array_map('count', $rows));
    }
}
