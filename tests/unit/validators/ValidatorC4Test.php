<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorC4Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'C4'));

        $this->validator = new ValidatorC4($bank);
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
            ['0000000019', true],
            ['0000292932', true],
            ['0000094455', true],

            ['0000000017', false],
            ['0000292933', false],
            ['0000094459', false],

            // Variant 2
            ['9000420530', true],
            ['9000010006', true],
            ['9000577650', true],

            ['9000726558', false],
            ['9001733457', false],
            ['9000732000', false],
        ];
    }
}
