<?php declare(strict_types=1);


namespace Luggage;


final class LuggageRule
{
    /**
     * @var LuggageBag
     */
    private LuggageBag $forBag;
    private int $containCount;

    public function __construct(LuggageBag $forBag, int $containCount)
    {
        $this->forBag = $forBag;
        $this->containCount = $containCount;
    }

    /**
     * @return LuggageBag
     */
    public function getForBag(): LuggageBag
    {
        return $this->forBag;
    }

    /**
     * @return int
     */
    public function getContainCount(): int
    {
        return $this->containCount;
    }

}
