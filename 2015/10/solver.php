<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

function look_and_say(string $numeric)
{
    $founds = [];
    $numbers = str_split($numeric, 1);
    $matching = $numbers[0];
    $counts = 0;
    foreach ($numbers as $num) {
        if ($num === $matching) {
            $counts++;
        } else {
            $founds[] = [$counts, $matching];
            $matching = $num;
            $counts = 1;
        }
    }
    $founds[] = [$counts, $matching];

    $packed = '';
    foreach ($founds as $each) {
        $packed .= implode($each);
    }
    return $packed;
}

$s = '1113222113';
for ($i = 0; $i < 50; $i++) {
    $s = look_and_say($s);
}

printf("(%d)\n", strlen($s));
