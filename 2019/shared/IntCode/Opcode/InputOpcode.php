<?php declare(strict_types=1);

namespace IntCode\Opcode;

use IntCode\Program;

final class InputOpcode extends CommonOpcode
{

    public const OPCODE = 3;
    public static $COLOR = 'light_green';

    public static function size(): int
    {
        return 2;
    }

    public function apply(): Program
    {
        $input = $this->program()->input()->read();
        printf("READ %d\n", $input);
        [$position] = $this->params();
        [$mode] = $this->modes();
        $this->program()->alter($position, $input, $mode);
        return parent::apply();
    }

}
