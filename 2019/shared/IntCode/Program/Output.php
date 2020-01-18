<?php declare(strict_types=1);

namespace IntCode\Program;

interface Output
{
    public function store(int $value): Output;
    public function outputs(): array;
}
