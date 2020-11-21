<?php declare(strict_types=1);

namespace Circuits\Gates;

use Circuits\SignalSource;

interface GateInterface extends SignalSource
{
    public function inputs(...$inputs);

    public function apply(...$inputs): int;
}
