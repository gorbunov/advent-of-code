<?php declare(strict_types=1);

namespace Circuits\Gates;

use Circuits\SignalSource;

final class LshiftGate implements SignalSource, GateInterface
{
    use StoresInputs;

    public const GATE_NAME = 'LSHIFT';

    public function apply(...$inputs): int
    {
        [$a, $b] = $inputs;
        return $a << $b;
    }
}
