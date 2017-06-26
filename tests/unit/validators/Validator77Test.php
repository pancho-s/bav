<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator77Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '77'));

        $this->validator = new Validator77($bank);
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
            ['10338', true],
            ['13844', true],
            ['65354', true],
            ['69258', true],

            ['10339', false],
            ['13845', false],
            ['65355', false],
            ['69259', false],
        ];
    }
}
