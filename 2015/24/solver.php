<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';
/** @var int[] $presents */
$presents = array_map('intval', file('./presents.txt', FILE_IGNORE_NEW_LINES));
$compartmentsCount = 3;

$targetWeight = (int)ceil(array_sum($presents) / $compartmentsCount);
printf("Target weight: %d\n", $targetWeight);
$presentsCount = count($presents);
$sampleSize = (int)($presentsCount / $compartmentsCount) + 2;
$options = [];
$shortest = $presentsCount;
for ($i = 0; $i < $sampleSize; $i++) {
    $firstCompartmentCombinations = \Math\Combinator::combinations($presents, $i + 1);
    /** @var int[] $firstCombination */
    foreach ($firstCompartmentCombinations as $firstCombination) {
        if (array_sum($firstCombination) !== $targetWeight) {
            continue;
        }
        if (count($firstCombination) > $shortest) {
            continue;
        }
        $restPresents = array_diff($presents, $firstCombination);
        if ((int)(array_sum($restPresents) / 2) !== $targetWeight) {
            continue;
        }
        $options[] = $firstCombination;
        printf("Options count: %d\n", count($options));
    }
}

var_dump(count($options));
