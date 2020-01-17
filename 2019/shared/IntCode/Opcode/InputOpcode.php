<?php declare(strict_types=1);

namespace IntCode\Opcode;

use IntCode\Program;

final class InputOpcode extends CommonOpcode
{

    public function apply(): Program
    {
        $input = $this->program()->input()->read();
        [$position] = $this->params();
        $this->program()->alter($position, $input);
        return parent::apply();
    }

    public static function size(): int
    {
        return 2;
    }

}
