<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorC3Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'C3'));

        $this->validator = new ValidatorC3($bank);
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
            ['9294182', true],
            ['4431276', true],
            ['19919', true],

            ['17002', false],
            ['123451', false],
            ['122448', false],

            // Variant 2
            ['9000420530', true],
            ['9000010006', true],
            ['9000577650', true],

            ['9000734028', false],
            ['9000733227', false],
            ['9000731120', false],
        ];
    }
}
