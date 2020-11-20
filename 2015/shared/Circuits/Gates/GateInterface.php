<?php declare(strict_types=1);

namespace Circuits\Gates;

use Circuits\SignalSource;

interface GateInterface
{
    public function inputs(...$inputs): SignalSource;
}
