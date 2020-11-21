<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$json = json_decode(file_get_contents('./accounting.json'), true, 512, JSON_THROW_ON_ERROR);

function section_amount(array $array): int
{
    $total = 0;
    if (in_array("red", $array, true) && count(array_filter(array_keys($array), '\is_string')) > 0) {
        return 0;
    }

    foreach ($array as $key => $value) {
        if (is_int($value)) {
            $total += $value;
        }
        if (is_array($value)) {
            $total += section_amount($value);
        }
    }
    return $total;
}

print section_amount($json);
