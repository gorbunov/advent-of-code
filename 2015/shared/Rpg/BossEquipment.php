<?php declare(strict_types=1);


namespace Rpg;


final class BossEquipment extends BaseEquipment
{
    public static function create(int $attack, int $defence): Equipment
    {
        return new self(0, $attack, $defence);
    }
}
