<?php declare(strict_types=1);


namespace Repairing;


use IntCode\Program\Input;

final class DroidController implements Input
{
    private $direction = Direction::NORTH;
    /**
     * @var AreaMap
     */
    private $map;
    /**
     * @var Position
     */
    private $position;

    private function __construct(AreaMap $map)
    {
        $this->map = $map;
        $this->position = Position::create(25, 25);
    }

    public static function create(AreaMap $map): DroidController
    {
        return new self($map);
    }

    public function read(): ?int
    {
        return $this->direction;
    }

    public function insert(int $value): Input
    {
        return $this;
    }

    public function reset(): Input
    {
        return $this;
    }

    public function status(int $status): self
    {
        switch ($status) {
            case AreaMap::EMPTY:
                $this->position->move($this->direction);
                break;
            case AreaMap::WALL:
                $this->direction = Direction::turn($this->direction);
                break;
        }
        $this->map->mark($this->position, $status);
        return $this;
    }

    public function __toString()
    {
        return sprintf("POS: %s, Turned: %s\n", $this->position, Direction::name($this->direction));
    }

    public function direction(): int
    {
        return $this->direction;
    }

}
