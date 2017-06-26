<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorA0Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'A0'));

        $this->validator = new ValidatorA0($bank);
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
            ['521003287', true],
            ['54500', true],
            ['3287', true],
            ['18761', true],
            ['28290', true],

            ['521003288', false],
            ['54501', false],
            ['3288', false],
            ['18762', false],
            ['28291', false],
        ];
    }
}
