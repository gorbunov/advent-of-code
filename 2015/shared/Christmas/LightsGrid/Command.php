<?php declare(strict_types=1);

namespace Christmas\LightsGrid;

final class Command
{
    public const TURN_ON = 'on';
    public const TURN_OFF = 'off';
    public const TURN_TOGGLE = 'toggle';
    private string $operation;
    private \Rectangle2D $rectangle;

    public static function parse(string $command): Command
    {
        preg_match("~^(?'command'.*) (?'corner1'\d+,\d+) through (?'corner2'\d+,\d+)$~", $command, $matches);
        $sp = explode(',', $matches['corner1']);
        $ep = explode(',', $matches['corner2']);

        $startCorner = \Position2D::create((int)$sp[0], (int)$sp[1]);
        $endCorner = \Position2D::create((int)$ep[0], (int)$ep[1]);
        return new self(self::parseOperation($matches['command']), $startCorner, $endCorner);
    }

    public function __construct(string $operation, \Position2D $start, \Position2D $end)
    {
        $this->operation = $operation;
        $this->rectangle = \Rectangle2D::create($start, $end);
    }

    /**
     * @return string
     */
    public function getOperation(): string
    {
        return $this->operation;
    }

    /**
     * @return \Rectangle2D
     */
    public function getRectangle(): \Rectangle2D
    {
        return $this->rectangle;
    }


    private static function parseOperation(string $op): string
    {
        switch (strtolower(trim($op))) {
            case 'toggle':
                return self::TURN_TOGGLE;
            case 'turn on';
                return self::TURN_ON;
            case 'turn off':
                return self::TURN_OFF;
            default:
                throw new \RuntimeException('Unknown operation');
        }
    }


}
