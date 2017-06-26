<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorB9Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'B9'));

        $this->validator = new ValidatorB9($bank);
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
            ['87920187', true],
            ['41203755', true],
            ['81069577', true],
            ['61287958', true],
            ['58467232', true],

            ['88034023', false],
            ['43025432', false],
            ['86521362', false],
            ['61256523', false],
            ['54352684', false],

            // Variant 2
            ['7125633', true],
            ['1253657', true],
            ['4353631', true],

            ['2356412', false],
            ['5435886', false],
            ['9435414', false],
        ];
    }
}
