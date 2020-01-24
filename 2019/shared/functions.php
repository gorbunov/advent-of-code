<?php declare(strict_types=1);

function print_array_values(array $array)
{
    $items = color_array($array, 'black');
    printf("%s\n", implode(', ', $items));
}

function color_value($value, $color = null)
{
    $colors = [
        'bold'         => '1',
        'dim'          => '2',
        'black'        => '0;30',
        'dark_gray'    => '1;30',
        'blue'         => '0;34',
        'light_blue'   => '1;34',
        'green'        => '0;32',
        'light_green'  => '1;32',
        'cyan'         => '0;36',
        'light_cyan'   => '1;36',
        'red'          => '0;31',
        'light_red'    => '1;31',
        'purple'       => '0;35',
        'light_purple' => '1;35',
        'brown'        => '0;33',
        'yellow'       => '1;33',
        'light_gray'   => '0;37',
        'white'        => '1;37',
        'normal'       => '0;39',
    ];

    $color = $colors[$color] ?? $colors['normal'];

    return sprintf("\e[%sm%s\e[0m", $color, $value);
}

function color_array(array $values, $color): array
{
    return array_map(
        static function ($value) use ($color) {
            if (is_array($value)) {
                $value = implode(', ', color_array($value, $color));
            }
            return color_value((string)$value, $color);
        },
        $values
    );
}

function print_image_preview(array $data)
{
    $colormap = [
        0 => 'white',
        1 => 'black',
    ];

    foreach ($data as $row) {
        foreach ($row as $symbol) {
            printf('%s', color_value('█', $colormap[$symbol]));
        }
        echo PHP_EOL;
    }
}

function gcd(int $a, int $b): int
{
    if ($b === 0) {
        return $a;
    }
    return gcd($b, $a % $b);
}

function lcm($nums): int {
    return array_reduce($nums, static function ($a, $b) { return ($a * $b) / gcd($a, $b); }, 1);
}
