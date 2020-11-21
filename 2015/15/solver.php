<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';
$ingredients = [
    'Butterscotch: capacity -1, durability -2, flavor 6, texture 3, calories 8',
    'Cinnamon: capacity 2, durability 3, flavor -2, texture -1, calories 3',
];

$ingredients = file('./ingredients.txt', FILE_IGNORE_NEW_LINES);


$recepie = new \Cookies\Recepie();
foreach ($ingredients as $ingredient) {
    $recepie->addIngredient(\Cookies\Ingredient::parse($ingredient));
}
$best = max(
    array_map(
        static function (\Cookies\Mixture $mixture) {
            return $mixture->getScore();
        },
        $recepie->mixAll()
    )
);

printf("Best score: %d\n", $best);

