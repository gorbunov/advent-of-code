<?php declare(strict_types=1);

namespace Circuits;

final class Wire implements SignalSource
{
    private string $name;
    private int $signal;
    private Connection $sourceConnection;

    private function __construct(string $name, int $signal)
    {
        $this->name = $name;
        $this->signal = $signal;
    }

    public static function create(string $name): Wire
    {
        return self::createWithSignal($name, -1);
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
        if ($this->signal === -1) {
            $this->signal = $this->sourceConnection->getSource()->getSignal();
        }
        return $this->signal;
    }

    public function setConnection(Connection $connection)
    {
        $this->sourceConnection = $connection;
        return $this;
    }

    public function reset()
    {
        $this->signal = -1;
    }
}
