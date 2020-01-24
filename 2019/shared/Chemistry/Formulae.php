<?php declare(strict_types=1);

namespace Chemistry;

final class Formulae
{
    /**
     * @var string
     */
    private $element;
    /**
     * @var array
     */
    private $requirements;
    /**
     * @var int
     */
    private $quantity;

    public static function parse(string $line): Formulae
    {
        $matches = [];
        preg_match('~^(.*)\s=>\s(\d+)\s(\w+)$~', $line, $matches);
        unset($matches[0]);
        [$requirements, $quantity, $element] = array_values($matches);
        $requirements = array_map('\trim', explode(',', $requirements));
        $reqs = [];
        foreach ($requirements as $requirement) {
            [$reqQuantity, $reqName] = explode(' ', $requirement, 2);
            $reqs[trim($reqName)] = (int)$reqQuantity;
        }
        return new self($element, (int)$quantity, $reqs);
    }

    private function __construct(string $element, int $quantity, array $requirements)
    {
        $this->element = $element;
        $this->requirements = $requirements;
        $this->quantity = $quantity;
    }

    public function element(): string
    {
        return $this->element;
    }

    public function requirements(): array
    {
        return $this->requirements;
    }

    public function quantity(): int
    {
        return $this->quantity;
    }

    public function produce(int $amount): array
    {
        $batches = (int)ceil($amount / $this->quantity);
        $recepie = array_map(
            static function ($amount) use ($batches) {
                return $amount * $batches;
            },
            $this->requirements
        );

        return [$this->quantity * $batches, $recepie];
    }
}
