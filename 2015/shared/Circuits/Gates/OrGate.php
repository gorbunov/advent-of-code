<?php declare(strict_types=1);

namespace Circuits\Gates;

use Circuits\SignalSource;

final class OrGate implements SignalSource, GateInterface
{
    use StoresInputs;

    public const GATE_NAME = 'OR';

    public function apply(...$inputs): int
    {
        [$a, $b] = $inputs;
        return $a | $b;
    }
}
