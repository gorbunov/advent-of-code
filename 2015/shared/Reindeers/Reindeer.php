<?php declare(strict_types=1);


namespace Reindeers;


final class Reindeer
{
    private string $name;
    private int $speed;
    private int $flytime;
    private int $resttime;
    private int $segmentTime;
    private int $segmentDistance;

    public function __construct(string $name, int $speed, int $flytime, int $resttime)
    {
        $this->name = $name;
        $this->speed = $speed;
        $this->flytime = $flytime;
        $this->resttime = $resttime;
        $this->segmentTime = $flytime + $resttime;
        $this->segmentDistance = $flytime * $speed;
    }

    public static function create(string $name, int $speed, int $flytime, int $resttime)
    {
        return new self($name, $speed, $flytime, $resttime);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function getDistanceAtTime(int $time): int
    {
        $distance = 0;
        $wholeSegmentCount = (int)floor($time / $this->segmentTime);
        $distance += $wholeSegmentCount * $this->segmentDistance; // total distance at whole segments
        $distance += $this->getDistanceMidSegment($time % $this->segmentTime);
        return $distance;
    }

    private function getDistanceMidSegment(int $segmentTime): int
    {
        if ($segmentTime >= $this->flytime) // fly whole segment at this time, now resting
        {
            return $this->segmentDistance;
        }

        return $this->speed * $segmentTime; // in flying at this point
    }


}
