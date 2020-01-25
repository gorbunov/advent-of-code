<?php declare(strict_types=1);

namespace Repairing;


final class AreaMap
{
    private function __construct()
    {
        $this->tiles = [];
    }

    public static function create(): AreaMap
    {
        return new self();
    }

    public function mark(int $x, int $y, int $type): self
    {
        $this->tiles[$y][$x] = $type;
        return $this;
    }

}
