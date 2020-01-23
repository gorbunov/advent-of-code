<?php declare(strict_types=1);


namespace IntCode\Opcode;

use IntCode\Program;

final class RelativeBaseOpcode extends CommonOpcode
{
    public const OPCODE = 9;

    public function apply(): Program
    {
        [$param] = $this->params();
        [$mode] = $this->modes();
        $offset = $this->program()->read($param, $mode);
        $this->program()->moveRelativeBase($offset);
        return $this->program()->advance(self::size());
    }

    public static function size(): int
    {
        return 2;
    }
}
