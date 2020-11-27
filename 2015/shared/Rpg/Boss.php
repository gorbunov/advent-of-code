<?php declare(strict_types=1);


namespace Rpg;


final class Boss extends BaseCharacter implements Character
{
    public static function create(string $definition): Character
    {
        preg_match("~Hit Points: (?'hp'\d+)\s?Damage: (?'damage'\d+)\s?Armor: (?'armor'\d+)~", $definition, $matches);
        $hp = (int)$matches['hp'];
        $dmg = (int)$matches['damage'];
        $armor = (int)$matches['armor'];
        $boss = new self('Boss', $hp, $hp);
        $eq = BossEquipment::create($dmg, $armor);
        $boss->wearEquipment($eq);
        return $boss;
    }

    public function reset(): void
    {
        $this->revive();
    }
}
