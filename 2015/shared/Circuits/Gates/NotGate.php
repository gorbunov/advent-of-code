<?php declare(strict_types=1);

namespace Circuits\Gates;

use Circuits\SignalSource;

final class NotGate implements SignalSource, GateInterface
{
    use StoresInputs;

    public const GATE_NAME = 'NOT';
    private int $signal = 0;


    public function apply(...$inputs): int
    {
        [$sourceSignal] = $inputs;
        return (65535 - $sourceSignal); // 16bit unsigned signal
    }

    /*
    public function inputs(...$inputs): SignalSource
    {
        // @var int $a
        [, $a] = $inputs;
        $this->signal = 65535 - $a;
        return $this;
    }
    */
}
