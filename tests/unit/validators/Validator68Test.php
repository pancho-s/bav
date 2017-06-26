<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator68Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '68'));

        $this->validator = new Validator68($bank);
    }

    /**
     * @param string $account The account id.
     * @param bool $expected The expected validation result.
     *
     * @dataProvider provideTestData
     */
    public function testIsValid($account, $expected)
    {
        $this->assertEquals($expected, $this->validator->isValid($account));
    }

    /**
     * Returns test cases for testIsValid().
     *
     * @return array Test cases.
     */
    public function provideTestData()
    {
        return [
            ['8889654328', true],
            ['987654324', true],
            ['987654328', true],

            ['8889654329', false],
            ['987654325', false],
            ['987654329', false],

            // accounts from 400 000 000 to 499 999 999 are not validatable because they do not contain a check sum
            ['400000000', false],
            ['400099900', false],
            ['499999999', false],
        ];
    }
}
