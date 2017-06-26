<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorD8Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'D8'));

        $this->validator = new ValidatorD8($bank);
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
            ['1403414848', true],
            ['6800000439', true],
            ['6899999954', true],

            ['3012084101', false],
            ['1062813622', false],
            ['0000260986', false],
        ];
    }
}
