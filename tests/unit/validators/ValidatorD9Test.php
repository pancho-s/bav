<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorD9Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'D9'));

        $this->validator = new ValidatorD9($bank);
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
            ['1234567897', true],
            ['0123456782', true],

            ['6543217890', false],
            ['0543216789', false],

            // Variant 2
            ['9876543210', true],
            ['1234567890', true],
            ['0123456789', true],

            ['6543217890', false],
            ['0543216789', false],

            // Variant 3
            ['1100132044', true],
            ['1100669030', true],

            ['1100789043', false],
            ['1100914032', false],
        ];
    }
}
