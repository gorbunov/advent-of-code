<?php declare(strict_types=1);

final class SantaRepository
{
    /** @var array|Santa[] */
    private array $santas = [];
    private int $current = 0;

    private function __construct(array $santas)
    {
        $this->santas = $santas;
    }

    public static function create(...$santas): \SantaRepository
    {
        return new self($santas);
    }

    public function getCurrentSanta(): Santa
    {
        return $this->santas[$this->current];
    }

    public function setNextSanta(): void
    {
        $this->current++;
        if ($this->current >= count($this->santas)) {
            $this->current = 0;
        }
    }
}
