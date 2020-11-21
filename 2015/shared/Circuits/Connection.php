<?php declare(strict_types=1);


namespace Circuits;


use Circuits\Gates\SignalValue;

final class Connection
{
    private SignalSource $source;
    private Wire $destination;

    private function __construct(SignalSource $source, Wire $destination)
    {
        $this->source = $source;
        $this->destination = $destination;
        $this->destination->setConnection($this);
    }

    public static function create(SignalSource $source, Wire $destination): Connection
    {
        return new self($source, $destination);
    }

    /**
     * @return SignalSource
     */
    public function getSource(): SignalSource
    {
        return $this->source;
    }

    /**
     * @return Wire
     */
    public function getDestination(): Wire
    {
        return $this->destination;
    }


}
