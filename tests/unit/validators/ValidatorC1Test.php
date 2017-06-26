<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorC1Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'C1'));

        $this->validator = new ValidatorC1($bank);
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
            ['0446786040', true],
            ['0478046940', true],
            ['0701625830', true],
            ['0701625840', true],
            ['0882095630', true],

            ['0446786240', false],
            ['0478046340', false],
            ['0701625730', false],
            ['0701625440', false],
            ['0882095130', false],

            // Variant 2
            ['5432112349', true],
            ['5543223456', true],
            ['5654334563', true],
            ['5765445670', true],
            ['5876556788', true],

            ['5432112341', false],
            ['5543223458', false],
            ['5654334565', false],
            ['5765445672', false],
            ['5876556780', false],
        ];
    }
}
