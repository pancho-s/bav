<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorC7Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'C7'));

        $this->validator = new ValidatorC7($bank);
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
            ['3500022', true],
            ['38150900', true],
            ['600103660', true],
            ['39101181', true],

            // Variant 2
            ['94012341', true],
            ['5073321010', true],

            ['1234517892', false],
            ['987614325', false],
        ];
    }
}
