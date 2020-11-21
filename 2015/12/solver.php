<?php declare(strict_types=1);
require_once __DIR__.'/../shared/autoload.php';

$json = json_decode(file_get_contents('./accounting.json'), true, 512, JSON_THROW_ON_ERROR);

$sum = 0;

array_walk_recursive(
    $json,
    static function ($value, $key) use (&$sum) {
        if (is_int($value)) {
            $sum += $value;
        }
    },
    $sum
);

print $sum;
