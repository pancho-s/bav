<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorA2Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'A2'));

        $this->validator = new ValidatorA2($bank);
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
            ['3456789019', true],
            ['5678901231', true],
            ['6789012348', true],

            // variant one
            ['1234567890', false],

            // variant two
            ['3456789012', true],

            // variant two
            ['1234567890', false],
            ['0123456789', false],
        ];
    }
}
