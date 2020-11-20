<?php declare(strict_types=1);

namespace Circuits\Gates;

use Circuits\SignalSource;

final class NotGate implements SignalSource, GateInterface
{
    public const GATE_NAME = 'NOT';
    private int $signal = 0;

    public function getSignal(): int
    {
        return $this->signal;
    }

    public function inputs(...$inputs): SignalSource
    {
        /** @var int $a */
        [, $a] = $inputs;
        $this->signal = 65535 - $a;
        return $this;
    }
}
