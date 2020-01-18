<?php declare(strict_types=1);

namespace IntCode\Program;

interface Input
{
    public function read(): ?int;
    public function insert(int $value): Input;
}
