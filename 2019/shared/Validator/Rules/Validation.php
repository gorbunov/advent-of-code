<?php declare(strict_types=1);


namespace Validator\Rules;

interface Validation
{
    public function validate(int $value): bool;
}
