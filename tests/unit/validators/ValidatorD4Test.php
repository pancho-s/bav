<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorD4Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'D4'));

        $this->validator = new ValidatorD4($bank);
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
            ['1112048219', true],
            ['2024601814', true],
            ['3000005012', true],
            ['4143406984', true],
            ['5926485111', true],
            ['6286304975', true],
            ['7900256617', true],
            ['8102228628', true],
            ['9002364588', true],

            ['0359432843', false],
            ['1000062023', false],
            ['2204271250', false],
            ['3051681017', false],
            ['4000123456', false],
            ['5212744564', false],
            ['6286420010', false],
            ['7859103459', false],
            ['8003306026', false],
            ['9916524534', false],
        ];
    }
}
