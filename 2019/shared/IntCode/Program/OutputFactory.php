<?php declare(strict_types=1);

namespace IntCode\Program;

class OutputFactory
{

    public static function create(): Output
    {
        return new SimpleOutput();
    }
}
