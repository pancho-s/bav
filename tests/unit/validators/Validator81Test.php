<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator81Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '81'));

        $this->validator = new Validator81($bank);
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
            ['0646440', true],
            ['1359100', true],

            ['0646441', false],
            ['1359101', false],

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
