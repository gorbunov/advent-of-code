<?php declare(strict_types=1);


namespace Rpg;


final class PlayerEquipment extends BaseEquipment
{
    public static function create(int $price, int $attack, int $defence): Equipment
    {
        return new static($price, $attack, $defence);
    }
}
