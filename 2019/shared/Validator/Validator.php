<?php declare(strict_types=1);

namespace Validator;

use Validator\Rules\Validation;

final class Validator
{
    /**
     * @var Validation[]
     */
    private $rules;

    private function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    /**
     * @param Validation[] $rules
     *
     * @return static
     */
    public static function create(array $rules): self
    {
        return new self($rules);
    }

    public function validate(int $value): bool
    {
        foreach ($this->rules as $rule) {
            if (!$rule->validate($value)) {
                return false;
            }
        }
        return true;
    }
}
