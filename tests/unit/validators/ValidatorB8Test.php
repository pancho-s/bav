<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorB8Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'B8'));

        $this->validator = new ValidatorB8($bank);
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
            // Variant 1
            ['0734192657', true],
            ['6932875274', true],

            ['0132572975', false],
            ['9000412340', false],
            ['9310305011', false],

            // Variant 2
            ['3145863029', true],
            ['2938692523', true],
            ['5011654366', true],

            ['0132572975', false],
            ['9000412340', false],
            ['9310305011', false],

            //Variant 3
            ['5100000000', true],
            ['5100000001', true],
            ['5999999998', true],
            ['5999999999', true],
            ['9010000000', true],
            ['9010000001', true],
            ['9109999998', true],
            ['9109999999', true],

            ['5099999999', false],
            ['6000000000', false],
            ['9009999999', false],
            ['9110000001', false],
        ];
    }
}
