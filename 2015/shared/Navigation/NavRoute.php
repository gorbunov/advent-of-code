<?php declare(strict_types=1);


namespace Navigation;


final class NavRoute
{
    private string $from;
    private string $to;
    private int $distance;

    public function __construct(string $from, string $to, int $distance)
    {
        $this->from = $from;
        $this->to = $to;
        $this->distance = $distance;
    }

    public static function parse(string $definition): NavRoute
    {
        preg_match("~^(?'from'\w+) to (?'to'\w+) = (?'distance'\d+)$~", $definition, $matches);
        return new self($matches['from'], $matches['to'], (int)$matches['distance']);
    }

    public function reverse(): NavRoute
    {
        return new self($this->getTo(), $this->getFrom(), $this->getDistance());
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * @return int
     */
    public function getDistance(): int
    {
        return $this->distance;
    }


}
