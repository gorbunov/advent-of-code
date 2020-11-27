<?php declare(strict_types=1);


namespace Rpg;


interface Character
{

    public function getName(): string;

    public function wearEquipment(Equipment $equipment);

    public function takeDamage(int $damage);

    public function isAlive(): bool;

    public function attack(Character $character);

    public function getAttack(): int;

    public function getDefence(): int;

    public function getHealth(): int;

    public function reset(): void;

    public function revive(): void;
}
