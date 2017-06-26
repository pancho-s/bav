<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorD6Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'D6'));

        $this->validator = new ValidatorD6($bank);
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
            ['3409', true],
            ['585327', true],
            ['1650513', true],

            ['33394', false],
            ['595795', false],
            ['16400501', false],

            // Variant 2
            ['3601671056', true],
            ['4402001046', true],
            ['6100268241', true],

            ['3615071237', false],
            ['6039267013', false],
            ['6039316014', false],

            // Variant 3
            ['7001000681', true],
            ['9000111105', true],
            ['9001291005', true],

            ['7004017653', false],
            ['9002720007', false],
            ['9017483524', false],
        ];
    }
}
