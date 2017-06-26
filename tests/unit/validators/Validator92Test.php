<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator92Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '92'));

        $this->validator = new Validator92($bank);
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
            ['4069613759', true],
            ['4069634518', true],
            ['4079604146', true],
            ['4129654921', true],

            ['4069613750', false],
            ['4069634519', false],
            ['4079604147', false],
            ['4129654922', false],
        ];
    }
}
