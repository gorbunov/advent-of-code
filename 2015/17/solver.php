<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$containers = file('./containers.txt', FILE_IGNORE_NEW_LINES);
$containers = array_map('\intval', $containers);
sort($containers, SORT_DESC | SORT_NUMERIC);
$ckeys = array_map(
    static function ($key) {
        return 'c'.$key;
    },
    range(1, count($containers))
);
$containers = array_combine($ckeys, $containers);
$maxAmount = 150;

/*$containers = ['a' => 20, 'b' => 15, 'c' => 10, 'd' => 5, 'e' => 5];
$maxAmount = 25;*/

function get_combinations($options, $created, $maxAmount)
{
    // var_dump('enter', $options, $created);
    $combos = [];
    $position = 0;
    foreach ($options as $key => $option) {
        $next_combo = $created + [$key => $option];
        if (array_sum($next_combo) > $maxAmount) {
            continue;
        }
        $rest = array_slice($options, 0, $position, true) + array_slice($options, $position + 1, null, true);
        // var_dump('next', $rest, $next_combo);
        $deeper_combos = get_combinations($rest, $next_combo, $maxAmount);
        if (!empty($deeper_combos)) {
            /** @noinspection SlowArrayOperationsInLoopInspection */
            $combos += $deeper_combos;
        } else {
            $kombo_keys = array_keys($next_combo);
            ksort($kombo_keys);
            $combos[implode('-', $kombo_keys)] = $next_combo;
        }
        $position++;
    }

    $combos = array_filter(
        $combos,
        static function ($combo) use ($maxAmount) {
            return array_sum($combo) === $maxAmount;
        }
    );

    return $combos;
}

$atLeast = get_combinations($containers, [], $maxAmount);
$known = [];
$exact = array_filter(
    $atLeast,
    static function ($combo) use ($maxAmount, &$known) {
        ksort($combo);
        $def = implode('-', array_keys($combo));
        if (in_array($def, $known, true)) {
            return false;
        }
        $known[] = $def;
        return (array_sum($combo) === $maxAmount);
    },
);

var_dump(count($exact));
