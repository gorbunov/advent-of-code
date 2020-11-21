<?php declare(strict_types=1);

namespace Aunts;

final class Matcher
{
    /** @var array|Sue[] */
    private array $aunts;

    public function __construct()
    {
        $this->aunts = [];
    }

    public function addAunt(Sue $sue)
    {
        $this->aunts[] = $sue;
    }

    public function match(array $descr): Sue
    {
        foreach ($this->aunts as $aunt) {
            if ($aunt->matches($descr)) {
                return $aunt;
            }
        }
        throw new \RuntimeException('No matching aunt!');
    }
}
