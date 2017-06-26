<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorE0Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'E0'));

        $this->validator = new ValidatorE0($bank);
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
            ['1234568013', true],
            ['1534568010', true],
            ['2610015', true],
            ['8741013011', true],

            ['1234769013', false],
            ['2710014', false],
            ['9741015011', false],
        ];
    }
}
