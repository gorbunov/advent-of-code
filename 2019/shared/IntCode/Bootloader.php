<?php declare(strict_types=1);

namespace IntCode;

interface Bootloader
{
    public function __invoke(Program $program): Program;
}
