<?php declare(strict_types=1);

namespace Circuits\Gates;

use Circuits\SignalSource;

final class AndGate implements SignalSource, GateInterface
{
    use StoresInputs;

    public const GATE_NAME = 'AND';

    public function apply(...$inputs): int
    {
        [$a, $b] = $inputs;
        return $a & $b;
    }

}
