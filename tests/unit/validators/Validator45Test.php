<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator45Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '45'));

        $this->validator = new Validator45($bank);
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
            ['3545343232', true],
            ['4013410024', true],

            // no check sum because 1st position equals 0 (zero)
            ['0994681254', true],
            ['0000012340', true],

            // no check sum available because 5th position equals 1 (one)
            ['1000199999', true],
            ['0100114240', true],

            ['3545343233', false],
            ['4013410025', false],

            // no check sum because 1st position equals 0 (zero) - negation
            ['1994681254', false],
            ['1000012340', false],

            // no check sum available because 5th position equals 1 (one) - negation
            ['1000299999', false],
            ['1100214240', false],
        ];
    }
}
