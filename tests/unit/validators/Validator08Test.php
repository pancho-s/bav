<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator08Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '08'));

        $this->validator = new Validator08($bank);
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
            ['59999', true],
            ['9290701', true],
            ['539290858', true],
            ['1501824', true],
            ['1501832', true],

            ['60000', false],
            ['9290702', false],
            ['539290859', false],
            ['1501825', false],
            ['1501833', false],
        ];
    }
}
