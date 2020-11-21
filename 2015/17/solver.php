<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$containers = file('./containers.txt', FILE_IGNORE_NEW_LINES);
$containers = array_map('\intval', $containers);

$containers = [20, 15, 10, 5, 5];
$maxAmount = 25;

function get_next_item($amount, $combination, $maxAmount)
{
    $combinations = [];
    foreach ($combination as $indx => $container) {
        $nextAmount = $amount + $container;
        if ($nextAmount === $maxAmount) {
            return $combinations[] = $container;
        }
        if ($nextAmount < $maxAmount) {
            $left = array_slice($combination, 0, $indx + 1) + array_slice($combination, $indx + 1);
            $next = get_next_item($nextAmount, $left, $maxAmount);
            if (!is_null($next)) {
                $combinations[] = [$container, $next];
            }
        }
    }
    return $combinations;
}

var_dump(get_next_item(0, $containers, $maxAmount));
