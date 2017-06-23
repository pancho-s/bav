<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorE4Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'E4'));

        $this->validator = new ValidatorE4($bank);
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
            ['1501836', true],
            ['9290702', true],
            ['539290858', true],

            // variant 2
            ['1501824', true],
            ['1501832', true],
            ['9290701', true],

            // wrong
            ['12345007', false],
            ['87654005', false],
        ];
    }
}
