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
    private static array $SUPPORTED_GATES = [
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

    public function parseConnection(string $definition): Connection
    {
        preg_match("~(?'source'.*) -> (?'dest'\w+)~", $definition, $matches);
        $destination = $this->getWire($matches['dest']);
        $source = $this->parseSource($matches['source']);
        return Connection::create($source, $destination);
    }

    public function getWire(string $name): Wire
    {
        return $this->wires[$name] ?? $this->addNewWire($name);
    }

    private function addNewWire(string $name): Wire
    {
        $this->wires[$name] = Wire::create($name);
        return $this->wires[$name];
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
        $operands = array_filter([trim($matches['op1']), trim($matches['op2'])]); // drop empty operands
        // convert to signal sources
        $inputs = array_map(
            function ($operand) {
                return $this->getOperand($operand);
            },
            $operands
        );
        $gate->inputs(...$inputs);
        // var_dump($gate);
        return $gate;
    }

    public static function createGate(string $type): GateInterface
    {
        return new self::$SUPPORTED_GATES[$type]();
    }

    public function getOperand(string $value): SignalSource
    {
        if (is_numeric($value)) {
            return SignalValue::create((int)$value);
        }
        return $this->getWire($value);
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

    public function getWireSignal(string $name): int
    {
        return $this->getWire($name)->getSignal();
    }

    public function getState(): void
    {
        ksort($this->wires);
        foreach ($this->wires as $wire) {
            printf("%s:\t%d\n", $wire->getName(), $wire->getSignal());
        }
    }

    public function reset()
    {
        array_walk(
            $this->wires,
            function (Wire $wire) {
                $wire->reset();
            }
        );
    }
}
