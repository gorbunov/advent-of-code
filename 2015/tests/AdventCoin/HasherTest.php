<?php

declare(strict_types=1);

namespace AdventCoin;

use PHPUnit\Framework\TestCase;

final class HasherTest extends TestCase
{

    public function hashesProvider(): array
    {
        return [
            ['abcdef', '609043', '000001dbbfa3a5c83a2d506429c7b00e'],
            ['pqrstuv', '1048970', '000006136ef2ff3b291c85725f17325c'],
        ];
    }

    /**
     * @dataProvider hashesProvider
     *
     * @param $secret
     * @param $value
     * @param $expected
     */
    public function testCalulateHashes($secret, $value, $expected)
    {
        $hasher = Hasher::create($secret, 5);
        self::assertEquals($expected, $hasher->hash($value), 'Hashes doesnt match');
    }

    public function testIsNotCoinHash()
    {
        $hasher = Hasher::create('random', 5);
        self::assertFalse($hasher->isCoinHash('hash'), 'Hash matches coin, but it shouldnt');
    }

    /**
     * @dataProvider hashesProvider
     *
     * @param $secret
     * @param $value
     * @param $expected
     */
    public function testIsCoinHash($secret, $value, $expected)
    {
        $hasher = Hasher::create($secret, 5);
        self::assertTrue($hasher->isCoinHash($value), 'Hash is not coin');
    }
}
