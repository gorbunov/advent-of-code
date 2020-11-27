<?php declare(strict_types=1);


namespace Rpg;


final class PlayerEquipment extends BaseEquipment
{
    public static function create(string $name, int $price, int $attack, int $defence): Equipment
    {
        return new static($name, $price, $attack, $defence);
    }
}
