<?php declare(strict_types=1);

namespace Circuits\Gates;

use Circuits\SignalSource;

final class LshiftGate implements SignalSource, GateInterface
{
    public const GATE_NAME = 'LSHIFT';
    private int $signal = 0;

    public function getSignal(): int
    {
        return $this->signal;
    }

    public function inputs(...$inputs): SignalSource
    {
        [$a, $b] = $inputs;
        $this->signal = $a << $b;
        return $this;
    }
}
