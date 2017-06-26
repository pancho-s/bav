<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator13Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '13'));

        $this->validator = new Validator13($bank);
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
            ['0225524', true],
            ['0247387', true],
            ['1002054', true],
            ['1005628', true],

            ['0225525', false],
            ['0247388', false],
            ['1002055', false],
            ['1005629', false],
        ];
    }
}
