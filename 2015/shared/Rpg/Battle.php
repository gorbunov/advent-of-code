<?php declare(strict_types=1);


namespace Rpg;


final class Battle
{
    /** @var Character[] */
    private array $participants;
    private int $current = 0;

    private function __construct(array $participants)
    {
        $this->participants = $participants;
    }

    public static function create(array $participants): Battle
    {
        return new self($participants);
    }

    public function battle(): void
    {
        while ($this->everybodyAlive()) {
            $this->doStep();
        }
    }

    public function everybodyAlive(): bool
    {
        $alive = true;
        foreach ($this->participants as $participant) {
            $alive = $alive && $participant->isAlive();
        }
        return $alive;
    }

    public function doStep(): void
    {
        $player = $this->getParticipant($this->current);
        $boss = $this->getParticipant($this->getNextId($this->current));
        $player->attack($boss);
        if ($boss->isAlive()) {
            $boss->attack($player);
        }
    }

    private function getParticipant(int $id): Character
    {
        return $this->participants[$id];
    }

    private function getNextId(int $currentId): int
    {
        $next = $currentId + 1;
        if ($next >= \count($this->participants)) {
            return 0;
        }
        return $next;
    }

    public function didPlayerWon(): bool
    {
        return $this->participants[0]->isAlive() && !$this->everybodyAlive();
    }

    public function reset(): void
    {
        foreach ($this->participants as $participant) {
            $participant->reset();
        }
    }
}
