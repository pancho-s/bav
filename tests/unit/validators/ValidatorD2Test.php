<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorD2Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'D2'));

        $this->validator = new ValidatorD2($bank);
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
            ['189912137', true],
            ['235308215', true],

            ['6414241', false],
            ['179751314', false],

            // Variant 2
            ['4455667784', true],
            ['1234567897', true],

            ['6414241', false],
            ['179751314', false],

            // Variant 3
            ['51181008', true],
            ['71214205', true],

            ['6414241', false],
            ['179751314', false],
        ];
    }
}
