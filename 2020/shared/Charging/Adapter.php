<?php declare(strict_types=1);

namespace Charging;

final class Adapter
{
    private int $rating;

    public function __construct(int $rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return int
     */
    public function getRating(): int
    {
        return $this->rating;
    }

    public function canTake(int $rating): bool
    {
        // has highter output rating than input && diff with required rating is not higher than 3
        return ($this->rating > $rating) && (($this->rating - $rating) <= 3);
    }

    public function canBePluggedInto(Adapter $adapter): bool
    {
        // my rating is lower than other, && other adapter rating higher than mine not more than by 3
        return (($this->rating < $adapter->rating) && ($adapter->rating - $this->rating) <= 3);
    }
}
