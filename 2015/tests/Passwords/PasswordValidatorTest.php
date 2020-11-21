<?php

namespace Passwords;

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

class PasswordValidatorTest extends TestCase
{

    public function passwordValidationProvider()
    {
        return [
            ['hijklmmn', false],
            ['abbceffg', false],
            ['abbcegjk', false],
            ['abcdffaa', true],
            ['ghjaabcc', true],
        ];
    }

    /**
     * @dataProvider passwordValidationProvider
     * @param $password
     * @param $isValid
     */
    public function testValidate($password, $isValid)
    {
        assertEquals($isValid, PasswordValidator::isValid($password));
    }
}
