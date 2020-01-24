<?php declare(strict_types=1);


namespace Painting\Hull;


class Hull
{

    private $panels;

    private function __construct()
    {
        $this->panels[0][0] = Panel::create(0, 0);
    }

    public static function create(): Hull
    {
        return new self();
    }

    public function panel(int $x, int $y): Panel
    {
        if (!isset($this->panels[$x][$y])) {
            $this->panels[$x][$y] = Panel::create($x, $y);
        }
        return $this->panels[$x][$y];
    }

    public function painted(): int
    {
        $painted = 0;
        foreach ($this->panels as $x => $row) {
            /** @var Panel $panel */
            foreach ($row as $y => $panel) {
                if ($panel->painted() > 0) {
                    $painted++;
                }
            }
        }
        return $painted;
    }
}
