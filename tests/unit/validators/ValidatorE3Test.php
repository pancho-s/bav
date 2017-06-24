<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorE3Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'E3'));

        $this->validator = new ValidatorE3($bank);
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
            // variant 1
            ['9290701', true],
            ['539290858', true],
            ['1501824', true],
            ['1501832', true],

            // variant 2
            ['9290708', true],
            ['539290854', true],
            ['1501823', true],
            ['1501831', true],
            ['2345678909', true],
            ['5678901237', true],

            // wrong
            ['0123456789', false],
            ['2345678901', false],
            ['5678901234', false],
            ['7414398260', false],
        ];
    }
}
