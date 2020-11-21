<?php declare(strict_types=1);

namespace Circuits\Gates;

use Circuits\SignalSource;

final class SignalValue implements SignalSource, GateInterface
{
    private int $signal;

    private function __construct(int $signal)
    {
        $this->signal = $signal;
    }

    public static function create(int $signal)
    {
        return new self($signal);
    }

    public function inputs(...$inputs): void
    {
    }

    public function apply(...$inputs): int
    {
        return $this->getSignal();
    }

    public function getSignal(): int
    {
        return $this->signal;
    }
}
