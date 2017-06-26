<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator93Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '93'));

        $this->validator = new Validator93($bank);
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
            // modulus 11
            ['6714790000', true],
            ['0000671479', true],

            // modulus 7
            ['1277830000', true],
            ['0000127783', true],
            ['1277910000', true],
            ['0000127791', true],

            // modulus 11 and 7
            ['3067540000', true],
            ['0000306754', true],

            // modulus 11
            ['6714700000', false],
            ['0000671470', false],

            // modulus 7
            ['1277840000', false],
            ['0000127784', false],
            ['1277920000', false],
            ['0000127792', false],

            // modulus 11 and 7
            ['3067550000', false],
            ['0000306755', false],
        ];
    }
}
