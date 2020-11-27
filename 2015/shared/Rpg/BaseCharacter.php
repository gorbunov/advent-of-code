<?php declare(strict_types=1);


namespace Rpg;

abstract class BaseCharacter implements Character
{
    private string $name;
    private int $attack = 0;
    private int $defence = 0;
    private int $totalHp;
    private int $currentHp;
    private array $equipment = [];

    public function __construct(string $name, int $totalHp, int $currentHp)
    {
        $this->name = $name;
        $this->totalHp = $totalHp;
        $this->currentHp = $currentHp;
    }

    public function wearEquipment(Equipment $equipment): void
    {
        $this->equipment[] = $equipment;
        $this->addAttack($equipment->getAttack());
        $this->addDefence($equipment->getDefence());
    }

    private function addAttack(int $amount): void
    {
        $this->attack += $amount;
    }

    private function addDefence(int $amount): void
    {
        $this->defence += $amount;
    }

    public function isAlive(): bool
    {
        return $this->currentHp > 0;
    }

    public function takeDamage(int $damage): void
    {
        $this->currentHp -= $this->getAppliedDamage($damage);
    }

    private function getAppliedDamage(int $attack): int
    {
        $damage = $attack - $this->getDefence();
        return $damage > 1 ? $damage : 1;
    }

    /**
     * @return int
     */
    public function getDefence(): int
    {
        return $this->defence;
    }

    public function attack(Character $character): void
    {
        printf("The %s deals (%d - %d) damage; ", $this->getName(), $this->getAttack(), $character->getDefence());
        $character->takeDamage($this->getAttack());
        printf("The %s goes down to %d hitpoints.\n", $character->getName(), $character->getHealth());
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getAttack(): int
    {
        return $this->attack;
    }

    public function getHealth(): int
    {
        return $this->currentHp;
    }
}
