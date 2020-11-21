<?php declare(strict_types=1);

namespace Cookies;

final class Recepie
{
    private array $ingredients;

    public function __construct()
    {
        $this->ingredients = [];
    }

    public function addIngredient(Ingredient $ingredient)
    {
        $this->ingredients[$ingredient->getName()] = $ingredient;
    }

    public function mix(array $percentages): Mixture
    {
        //printf("Mixing %d / %d / %d / %d\n", ...$percentages);
        $mixture = new Mixture();
        $index = 0;
        foreach ($this->ingredients as $ingredient) {
            $mixture->addIngredient($percentages[$index], $ingredient);
            $index++;
        }
        return $mixture;
    }

    public function getIngredientsCount(): int
    {
        return \count($this->ingredients);
    }

    /**
     * @return array|Mixture[]
     */
    public function mixAll(): array
    {
        $mixtures = [];
        for ($p1 = 0; $p1 <= 100; $p1++) {
            for ($p2 = 0; $p2 <= 100 - $p1; $p2++) {
                for ($p3 = 0; $p3 <= (100 - $p1) - $p2; $p3++) {
                    $p4 = 100 - ($p3 + $p2 + $p1);
                    $mixtures[] = $this->mix([$p1, $p2, $p3, $p4]);
                }
            }
        }
        return $mixtures;
    }

}
