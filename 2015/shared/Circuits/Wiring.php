<?php declare(strict_types=1);

namespace Circuits;

use Circuits\Gates\OrGate;
use Circuits\Gates\NotGate;
use Circuits\Gates\AndGate;
use Circuits\Gates\LshiftGate;
use Circuits\Gates\RshiftGate;
use Circuits\Gates\SignalValue;
use Circuits\Gates\GateInterface;

final class Wiring
{
    private static $SUPPORTED_GATES = [
        'NOT'    => NotGate::class,
        'AND'    => AndGate::class,
        'LSHIFT' => LshiftGate::class,
        'RSHIFT' => RshiftGate::class,
        'OR'     => OrGate::class,
    ];
    /** @var array|Wire[] */
    private array $wires;

    private function __construct()
    {
        $this->wires = [];
    }

    public static function create(): Wiring
    {
        return new self();
    }

    private function addNewWire(string $name): Wire
    {
        $this->wires[$name] = Wire::create($name);
        return $this->wires[$name];
    }

    public function getWire(string $name): Wire
    {
        return $this->wires[$name] ?? $this->addNewWire($name);
    }

    public function getWireSignal(string $name): int
    {
        return $this->getWire($name)->getSignal();
    }

    public function parseConnection(string $definition)
    {
        preg_match("~(?'source'.*) -> (?'dest'\w+)~", $definition, $matches);
        $destination = $this->getWire($matches['dest']);
        $source = $this->parseSource($matches['source']);
        $destination->setSignal($source->getSignal());
        // var_dump($source->getSignal(), $destination);
    }

    public function parseSource(string $source): SignalSource
    {
        if (is_numeric($source)) {
            return SignalValue::create((int)$source);
        }
        if (strpos($source, ' ') === false) {
            return $this->getWire($source);
        }
        $supportedGatesString = implode('|', array_keys(self::$SUPPORTED_GATES));
        preg_match("~(?'op1'.*)\s?(?'gate'$supportedGatesString) (?'op2'\w+)~", $source, $matches, PREG_UNMATCHED_AS_NULL);
        $gate = self::createGate($matches['gate']);
        $inputs = [$this->getValueOrSignal(trim($matches['op1'])), $this->getValueOrSignal(trim($matches['op2']))];
        return $gate->inputs(...$inputs);
    }

    public function getState(): void
    {
        foreach ($this->wires as $wire) {
            printf("%s:\t%d\n", $wire->getName(), $wire->getSignal());
        }
    }

    public static function createGate(string $type): GateInterface
    {
        return new self::$SUPPORTED_GATES[$type];
    }

    public function getValueOrSignal(?string $value): ?int
    {
        if (($value === null) || empty($value)) {
            return null;
        }
        if (is_numeric($value)) {
            return (int)$value;
        }
        return $this->getWireSignal($value);
    }
}
