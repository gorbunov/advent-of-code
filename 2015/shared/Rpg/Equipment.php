<?php declare(strict_types=1);


namespace Rpg;


interface Equipment
{
    public function getDefence(): int;

    public function getPrice(): int;

    public function getAttack(): int;
}
