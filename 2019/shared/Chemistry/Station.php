<?php declare(strict_types=1);

namespace Chemistry;

final class Station
{
    private const DEBUG = false;
    /**
     * @var Formulae[]
     */
    private $formulas;
    /**
     * @var Storage
     */
    private $storage;

    public static function create(array $lines): Station
    {
        $formulas = [];
        foreach ($lines as $line) {
            $formulae = Formulae::parse($line);
            $formulas[$formulae->element()] = $formulae;
        }
        return new self($formulas);
    }

    private function __construct(array $formulas)
    {
        $this->formulas = $formulas;
        $this->storage = Storage::create();
    }

    public function mix(string $element, int $amount)
    {
        if ($element === 'ORE') {
            return $this;
        }
        $formulae = $this->formulas[$element];
        [$produced, $requirements] = $formulae->produce($amount);
        if (self::DEBUG) {
            printf("Producing %s, recipe quantity: %d, requested: %d, created: %d\n", $element, $formulae->quantity(), $amount, $produced);
        }
        $this->storage->store($element, $produced);
        foreach ($requirements as $reqElement => $reqAmount) {
            $needed = $this->storage->consume($reqElement, $reqAmount);
            if ($needed < 0) {
                $this->mix($reqElement, -1 * $needed);
            }
        }
        return $this;
    }

    public function storage(): Storage
    {
        return $this->storage;
    }

    public function produce(string $string)
    {
        while ($this->storage->get('ORE') > 0) {
            $this->mix('FUEL', 1);
        }
    }
}
