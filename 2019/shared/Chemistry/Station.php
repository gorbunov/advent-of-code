<?php declare(strict_types=1);

namespace Chemistry;

final class Station
{
    /**
     * @var Formulae[]
     */
    private $formulas;

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
    }

    public function mix(string $element, int $amount)
    {
        $formulae = $this->formulas[$element];
        return $formulae->produce($amount);
        var_dump($formulae);
    }
}
