<?php declare(strict_types=1);

namespace Cookies;

final class Mixture
{
    /** @var array|Ingredient[] */
    private array $ingredients;

    public function __construct()
    {
        $this->ingredients = [];
    }

    public function addIngredient(int $amount, Ingredient $ingredient)
    {
        $this->ingredients[$amount] = $ingredient;
    }

    public function getScore(): int
    {
        return array_product(
            [
                $this->getCapacityScore(),
                $this->getDurabilityScore(),
                $this->getFlavorScore(),
                $this->getTextureScore(),
                $this->getCalorieScore(),
            ]
        );
    }

    private function getPropertyScore(string $property): int
    {
        $getter = 'get'.ucfirst(strtolower($property));
        $score = 0;
        foreach ($this->ingredients as $amount => $ingredient) {
            $score += $ingredient->$getter() * $amount;
            //printf("mixing %s: amount: %d, %s: %d, score: %d\n", $ingredient->getName(), $amount, $property, $ingredient->$getter(), $score);
        }

        return $score < 0 ? 0 : $score;
    }

    private function getCapacityScore(): int
    {
        return $this->getPropertyScore('capacity');
    }

    private function getDurabilityScore(): int
    {
        return $this->getPropertyScore('durability');
    }

    private function getFlavorScore(): int
    {
        return $this->getPropertyScore('flavor');
    }

    private function getTextureScore(): int
    {
        return $this->getPropertyScore('texture');
    }

    private function getCalorieScore(): int
    {
        $calories = $this->getPropertyScore('calories');
        return ($calories === 500) ? 1 : 0;
    }
}
