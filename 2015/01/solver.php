<?php declare(strict_types=1);
$directions = trim(file_get_contents('./directions.txt', false));
$chars = count_chars($directions, 1);
[$up, $down] = array_values($chars);
printf("Santa is at floor %d\n", $up - $down); // 280
$movement = str_split($directions, 1);
$floor = 0;
foreach ($movement as $pos => $step) {
    if ($step ==='(') {
        $floor++;
    } elseif ($step === ')') {
        $floor--;
    }
    if ($floor === -1) {
        printf("Santa entered basement at step %d\n", $pos+1);
        break;
    }
}
