<?php declare(strict_types=1);

namespace Gravity;

final class Body
{
    /**
     * @var Position
     */
    private $position;
    /**
     * @var Position
     */
    private $velocity;

    private function __construct(Position $position)
    {
        $this->position = $position;
        $this->velocity = Position::create(0, 0, 0);
    }

    public static function create(int $x, int $y, int $z): Body
    {
        return new self(Position::create($x, $y, $z));
    }

    public function velocity(): Position
    {
        return $this->velocity;
    }

    public function __toString()
    {
        return sprintf("pos=%s \t\tvel=%s\t\t\tkin=%d,\tpot=%d,\ttot=%d", $this->position, $this->velocity, $this->kinetic(), $this->potential(), $this->energy());
    }

    public function kinetic(): int
    {
        return abs($this->velocity->x()) + abs($this->velocity->y()) + abs($this->velocity->z());
    }

    public function potential(): int
    {
        return abs($this->position->x()) + abs($this->position->y()) + abs($this->position->z());
    }

    public function energy(): int
    {
        return $this->potential() * $this->kinetic();
    }

    public function applyBodyGravity(Body $body): self
    {
        $this->velocity->modify(
            $body->position->x() <=> $this->position()->x(),
            $body->position->y() <=> $this->position()->y(),
            $body->position->z() <=> $this->position()->z(),
            );

        return $this;
    }

    public function position(): Position
    {
        return $this->position;
    }

    public function applyVelocity(): self
    {
        $this->position->modify($this->velocity->x(), $this->velocity->y(), $this->velocity->z());
        return $this;
    }
}
