<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator99Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '99'));

        $this->validator = new Validator99($bank);
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
            ['0396000000', true],
            ['0499999999', true],
            ['0068007003', true],
            ['0847321750', true],

            ['0395999999', false],
            ['0500000000', false],
            ['0068007004', false],
            ['0847321751', false],
        ];
    }
}
