<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator60Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '60'));

        $this->validator = new Validator60($bank);
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
            ['109290701', true],
            ['101501824', true],
            ['101501832', true],

            ['109290702', false],
            ['101501825', false],
            ['101501833', false],
        ];
    }
}
