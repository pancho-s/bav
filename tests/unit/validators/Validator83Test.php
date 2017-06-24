<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator83Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '83'));

        $this->validator = new Validator83($bank);
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
            // method A
            ['0001156071', true],
            ['0001156136', true],

            // method A
            ['0001156072', false],
            ['0001156137', false],

            // method B
            ['0000156078', true],

            // method B
            ['0000156079', false],

            // method C
            ['0000156071', true],

            // method C
            ['0000156072', false],

            // "Sachkonten" method A
            ['0099100002', true],

            // "Sachkonten" method A
            ['0099100003', false],
        ];
    }
}
