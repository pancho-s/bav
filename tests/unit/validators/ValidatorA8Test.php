<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorA8Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'A8'));

        $this->validator = new ValidatorA8($bank);
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
            ['7436661', true],
            ['7436670', true],
            ['1359100', true],

            // variant one
            ['7436662', false],
            ['7436671', false],
            ['1359101', false],

            // variant two
            ['7436660', true],
            ['7436678', true],
            ['0003503398', true],
            ['0001340967', true],

            // variant two
            ['7436666', false],
            ['7436677', false],
            ['0003503391', false],
            ['0001340966', false],

            // exceptions - calculation as exceptions in validator 51
            ['0199100002', true],
            ['0099100010', true],
            ['2599100002', true],
            ['0199100004', true],
            ['2599100003', true],
            ['3199204090', true],

            // exceptions - calculation as exceptions in validator 51
            ['0099345678', false],
            ['0099345678', false],
            ['0099100110', false],
            ['0199100040', false],
        ];
    }
}
