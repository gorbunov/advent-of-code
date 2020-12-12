<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$adapters = file('./jolts.txt', FILE_IGNORE_NEW_LINES);
//$adapters = file('./jolts-example2.txt', FILE_IGNORE_NEW_LINES);
//$adapters = file('./jolts-example.txt', FILE_IGNORE_NEW_LINES);

$adapters = array_map('\intval', $adapters);

$adapters = \Charging\AdaptersList::parse($adapters);
$outlet = new \Charging\Adapter(0);

$chain = $adapters->begin($outlet);
$diffs = \Charging\AdaptersList::getJoltDiff($chain);

printf("All chargers used jolt diffs are: +1: %d, +3: %d = %d\n", $diffs[1], $diffs[3], $diffs[1] * $diffs[3]);

$known = [0 => 1];
$chains = $adapters->backtrack($adapters->getDevice(), $outlet, $known);
printf("Total connectable chains (backtrack): %d\n", $chains);

/*
$chains = $adapters->chains($outlet, $adapters->getDevice());
printf("Total connectable chains (direct): %d\n", $chains);
*/

