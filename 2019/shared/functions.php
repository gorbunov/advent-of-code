<?php declare(strict_types=1);

function print_array_values(array $array)
{
    $items = array_map(
        static function ($item) {
            return (string)$item;
        },
        $array
    );
    printf("%s\n", implode(', ', $items));
}
