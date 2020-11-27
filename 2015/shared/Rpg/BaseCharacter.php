<?php declare(strict_types=1);


namespace Rpg;

abstract class BaseCharacter
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

    public function wearEquipment(Equipment $equipment)
    {
        $this->equipment[] = $equipment;
        $this->addAttack($equipment->getAttack());
        $this->addDefence($equipment->getDefence());
    }

    private function addAttack(int $amount)
    {
        $this->attack += $amount;
    }

    private function addDefence(int $amount)
    {
        $this->defence += $amount;
    }
}
