<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorA3Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'A3'));

        $this->validator = new ValidatorA3($bank);
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
            ['1234567897', true],
            ['0123456782', true],

            // variant one
            ['6543217890', false],
            ['0543216789', false],

            // variant two
            ['9876543210', true],
            ['1234567890', true],
            ['0123456789', true],

            // variant two
            ['6543217890', false],
            ['0543216789', false],
        ];
    }
}
