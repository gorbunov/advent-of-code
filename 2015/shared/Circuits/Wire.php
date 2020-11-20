<?php declare(strict_types=1);

namespace Circuits;

final class Wire implements SignalSource
{
    private string $name;
    private int $signal;

    private function __construct(string $name, int $signal)
    {
        $this->name = $name;
        $this->signal = $signal;
    }

    public static function create(string $name): Wire
    {
        return self::createWithSignal($name, 0);
    }

    public static function createWithSignal(string $name, int $signal): Wire
    {
        return new self($name, $signal);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSignal(): int
    {
        return $this->signal;
    }

    public function setSignal(int $signal): void
    {
        $this->signal = $signal;
    }
}
