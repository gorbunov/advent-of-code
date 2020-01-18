<?php declare(strict_types=1);

namespace IntCode\Opcode;

use IntCode\Program;

final class OutputOpcode extends CommonOpcode
{
    public const OPCODE = 4;
    public static $COLOR = 'light_purple';

    public static function size(): int
    {
        return 2;
    }

    public function apply(): Program
    {
        [$params] = $this->params();
        [$mode] = $this->modes();
        $value = $this->program()->read($params, $mode);
        $this->program()->output()->store($value);
        return parent::apply();
    }
}
