<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator74Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 74));

        $this->validator = new Validator74($bank);

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
            // variant 1
            ['1016', true],
            ['26260', true],
            ['242243', true],
            ['242248', true],
            ['18002113', true],
            ['1821200043', true],
            ['1011', false],
            ['26265', false],
            ['18002118', false],
            ['6160000024', false],

            // variant 2
            ['1015', true],
            ['26263', true],
            ['242241', true],
            ['18002116', true],
            ['1821200047', true],
            ['3456789012', true],
            ['242249', false],
            ['1234567890', false],
        ];
    }
}
