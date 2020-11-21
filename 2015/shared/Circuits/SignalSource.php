<?php

declare(strict_types=1);


namespace Circuits;


interface SignalSource
{
    public function getSignal(): int;
}
