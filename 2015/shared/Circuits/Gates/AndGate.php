<?php declare(strict_types=1);

namespace Circuits\Gates;

use Circuits\SignalSource;

final class AndGate implements SignalSource, GateInterface
{
    public const GATE_NAME = 'AND';
    private int $signal = 0;

    public function getSignal(): int
    {
        return $this->signal;
    }

    public function inputs(...$inputs): SignalSource
    {
        [$a, $b] = $inputs;
        $this->signal = $a & $b;
        return $this;
    }
}
