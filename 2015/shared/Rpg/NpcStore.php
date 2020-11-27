<?php declare(strict_types=1);


namespace Rpg;


use Math\Permutator;

final class NpcStore
{
    /**
     * @return array|EquipmentSet[]
     */
    public static function getCombinations(): array
    {
        $filtered = array_filter(
            self::getUnfilteredCombinations(),
            static function (/** @var Equipment[] $combination */ $combination) {
                // filter where wearing same rings, but not "no ring"
                $ring1price = $combination[2]->getPrice();
                $ring2price = $combination[3]->getPrice();
                return !(($ring1price !== 0) && ($ring1price === $ring2price));
            }
        );

        return array_map(
            static function ($set) {
                return EquipmentSet::create($set);
            },
            $filtered
        );
    }

    private static function getUnfilteredCombinations(): array
    {
        return Permutator::cartesian_product_combinations(
            [
                self::getSwords(),
                self::getArmor(),
                self::getRings(),
                self::getRings(),
            ]
        );
    }

    private static function getSwords(): array
    {
        /**
         * Weapons:    Cost  Damage  Armor
         * Dagger        8     4       0
         * Shortsword   10     5       0
         * Warhammer    25     6       0
         * Longsword    40     7       0
         * Greataxe     74     8       0
         */
        return [
            PlayerEquipment::create('Dagger', 8, 4, 0),
            PlayerEquipment::create('Shortsword', 10, 5, 0),
            PlayerEquipment::create('Warhammer', 25, 6, 0),
            PlayerEquipment::create('Longsword', 40, 7, 0),
            PlayerEquipment::create('Greataxe', 74, 8, 0),
        ];
    }

    private static function getArmor(): array
    {
        /**
         * Armor:      Cost  Damage  Armor
         * Leather      13     0       1
         * Chainmail    31     0       2
         * Splintmail   53     0       3
         * Bandedmail   75     0       4
         * Platemail   102     0       5
         */
        return [
            PlayerEquipment::create('No armor', 0, 0, 0),

            PlayerEquipment::create('Leather', 13, 0, 1),
            PlayerEquipment::create('Chainmail', 31, 0, 2),
            PlayerEquipment::create('Splintmail', 53, 0, 3),
            PlayerEquipment::create('Bandedmail', 75, 0, 4),
            PlayerEquipment::create('Platemail', 102, 0, 5),

        ];
    }

    private static function getRings(): array
    {
        /**
         * Rings:      Cost  Damage  Armor
         * Damage +1    25     1       0
         * Damage +2    50     2       0
         * Damage +3   100     3       0
         * Defense +1   20     0       1
         * Defense +2   40     0       2
         * Defense +3   80     0       3
         */
        return [
            PlayerEquipment::create('No ring', 0, 0, 0),

            PlayerEquipment::create('Ring of Damage +1', 25, 1, 0),
            PlayerEquipment::create('Ring of Damage +2', 50, 2, 0),
            PlayerEquipment::create('Ring of Damage +3', 100, 3, 0),

            PlayerEquipment::create('Ring of Defense +1', 20, 0, 1),
            PlayerEquipment::create('Ring of Defense +2', 40, 0, 2),
            PlayerEquipment::create('Ring of Defense +3', 80, 0, 3),

        ];
    }
}
