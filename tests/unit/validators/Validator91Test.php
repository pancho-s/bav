<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator91Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '91'));

        $this->validator = new Validator91($bank);
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
            // variant one
            ['2974118000', true],
            ['5281741000', true],
            ['9952810000', true],

            // variant one
            ['8840017000', false],
            ['8840023000', false],
            ['8840041000', false],

            // variant two
            ['2974117000', true],
            ['5281770000', true],
            ['9952812000', true],

            // variant two
            ['8840014000', false],
            ['8840026000', false],

            // variant three
            ['8840019000', true],
            ['8840050000', true],
            ['8840087000', true],
            ['8840045000', true],

            // variant three
            ['8840011000', false],
            ['8840025000', false],
            ['8840062000', false],

            // variant four
            ['8840012000', true],
            ['8840055000', true],
            ['8840080000', true],

            // variant four
            ['8840010000', false],
            ['8840057000', false],
        ];
    }
}
