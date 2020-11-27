<?php declare(strict_types=1);


namespace AsmRunner;


final class CpuState
{
    private array $registries = [];
    private int $position;

    public function __construct()
    {
        $this->reset();
    }

    private function reset()
    {
        $this->registries['a'] = 0;
        $this->registries['b'] = 0;
        $this->position = 0;
    }

    public static function createNextFrom(CpuState $cpuState): CpuState
    {
        $new = self::create();
        $new->setPosition($cpuState->getPosition() + 1);
        foreach (['a', 'b'] as $registry) {
            $new->setRegistry($registry, $cpuState->getRegistry($registry));
        }

        return $new;
    }

    public static function create(): CpuState
    {
        return new self();
    }

    /**
     * @return int
     */
    public function getPosition(): int
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition(int $position): void
    {
        $this->position = $position;
    }

    public function setRegistry(string $name, int $value): void
    {
        $this->registries[$name] = $value;
    }

    public function getRegistry(string $name): int
    {
        return $this->registries[$name];
    }
}
