<?php declare(strict_types=1);

namespace Boarding;

final class BoardingPass
{
    private string $row;
    private string $seat;

    public function __construct(string $row, string $seat)
    {
        $this->row = $row;
        $this->seat = $seat;
    }

    public static function parse(string $number): BoardingPass
    {
        return new self(...str_split($number, 7));
    }

    /**
     * @return string
     */
    public function getRow(): string
    {
        return $this->row;
    }

    /**
     * @return string
     */
    public function getSeat(): string
    {
        return $this->seat;
    }

    public function getRowNumber(): int
    {
        $row = str_split($this->getRow());
        return BSearch::define('F', 'B')->search($row, 128, 0);
    }

    public function getSeatNumber(): int
    {
        $seat = str_split($this->getSeat());
        return BSearch::define('L', 'R')->search($seat, 8, 0);
    }

    public function getSeatId(): int
    {
        return $this->getSeatNumber() + ($this->getRowNumber() * 8);
    }

    public function __toString(): string
    {
        return sprintf("Row: %d, Seat: %d, SeatId: %d", $this->getRowNumber(), $this->getSeatNumber(), $this->getSeatId());
    }
}
