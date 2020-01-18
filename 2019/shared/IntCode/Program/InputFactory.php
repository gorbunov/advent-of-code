<?php declare(strict_types=1);


namespace IntCode\Program;

final class InputFactory
{

    public static function empty(): Input
    {
        return self::create([]);
    }

    public static function create(array $inputs): Input
    {
        return new SimpleInput($inputs);
    }
}
