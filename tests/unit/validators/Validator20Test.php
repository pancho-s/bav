<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator20Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '20'));

        $this->validator = new Validator20($bank);
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
            ['479381', true],
            ['824305', true],
            ['1154257', true],
            ['1273426', true],

            ['479382', false],
            ['824306', false],
            ['1154258', false],
            ['1273427', false],
        ];
    }
}
