<?php declare(strict_types=1);

namespace Rpg;

class EquipmentSet
{
    /** @var array|\Rpg\Equipment[] */
    private array $equipment;

    public function __construct(array $equipment)
    {
        $this->equipment = $equipment;
    }

    public static function create(array $equipment): EquipmentSet
    {
        return new self($equipment);
    }

    public function wearOn(\Rpg\Character $character)
    {
        foreach ($this->equipment as $piece) {
            $character->wearEquipment($piece);
        }
    }

    public function getTotalPrice(): int
    {
        $price = 0;
        foreach ($this->equipment as $piece) {
            $price += $piece->getPrice();
        }
        return $price;
    }
}
