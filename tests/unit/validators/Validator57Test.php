<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator57Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '57'));

        $this->validator = new Validator57($bank);
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
            ['7500021766', true],
            ['9400001734', true],
            ['7800028282', true],
            ['8100244186', true],
            ['3251080371', true],
            ['3891234567', true],
            ['7777778800', true],
            ['5001050352', true],
            ['5045090090', true],
            ['1909700805', true],
            ['9322111030', true],
            ['7400060823', true],

            ['5302707782', false],
            ['6412121212', false],
            ['1813499124', false],
            ['2206735010', false],
        ];
    }
}
