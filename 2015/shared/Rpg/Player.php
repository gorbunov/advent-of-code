<?php declare(strict_types=1);


namespace Rpg;


final class Player extends BaseCharacter
{

    public function reset(): void
    {
        $this->revive();
        $this->dropEquipment();
    }
}
