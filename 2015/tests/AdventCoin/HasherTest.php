<?php

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
        $hasher = Hasher::create($secret);
        self::assertEquals($expected, $hasher->hash($value), 'Hashes doesnt match');
    }
}
