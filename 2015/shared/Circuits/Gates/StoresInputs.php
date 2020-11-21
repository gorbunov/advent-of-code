<?php declare(strict_types=1);


namespace Circuits\Gates;


use Circuits\SignalSource;

trait StoresInputs
{
    /** @var array|SignalSource[] $inputs */
    private array $inputs;

    public function inputs(...$inputs): void
    {
        $this->inputs = $inputs;
    }

    public function getSignal(): int
    {
        $signals = [];
        foreach ($this->getInputs() as $input) {
            $signals[] = $input->getSignal();
        }
        return $this->apply(...$signals);
    }

    /**
     * @return array|SignalSource[]
     */
    public function getInputs(): array
    {
        return $this->inputs;
    }
}
