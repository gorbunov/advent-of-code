<?php declare(strict_types=1);


namespace Repairing;


use IntCode\Program\Input;

final class DroidController implements Input
{
    public static function create(): DroidController
    {
        return new self();
    }

    public function read(): ?int
    {
        try {
            return random_int(1, 4);
        } catch (\Exception $e) {
            return 0;
        }
    }

    public function insert(int $value): Input
    {
        return $this;
    }

    public function reset(): Input
    {
        return $this;
    }

    public function status(int $status)
    {

    }
}
