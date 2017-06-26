<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorB1Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'B1'));

        $this->validator = new ValidatorB1($bank);
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
            ['1434253150', true],
            ['2746315471', true],

            // variant one
            ['0123456789', false],
            ['2345678901', false],
            ['5678901234', false],

            // variant 2
            ['7414398260', true],
            ['8347251693', true],

            // variant two
            ['0123456789', false],
            ['2345678901', false],
            ['5678901234', false],

            // variant 3
            ['1501824', true],
            ['1501832', true],
            ['539290858', true],
            ['7414398268', true],
            ['8347251699', true],

            // variant three
            ['0123456789', false],
            ['2345678901', false],
            ['5678901234', false],
        ];
    }
}
