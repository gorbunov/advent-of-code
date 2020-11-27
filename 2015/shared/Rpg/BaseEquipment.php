<?php declare(strict_types=1);


namespace Rpg;


abstract class BaseEquipment implements Equipment
{
    private int $attack;
    private int $defence;
    private int $price;

    protected function __construct(int $price, int $attack, int $defence)
    {
        $this->price = $price;
        $this->attack = $attack;
        $this->defence = $defence;
    }

    /**
     * @return int
     */
    public function getAttack(): int
    {
        return $this->attack;
    }

    /**
     * @return int
     */
    public function getDefence(): int
    {
        return $this->defence;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }
}
