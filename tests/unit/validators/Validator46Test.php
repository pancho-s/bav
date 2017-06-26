<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator46Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '46'));

        $this->validator = new Validator46($bank);
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
            ['0235468612', true],
            ['0837890902', true],
            ['1041447600', true],

            ['0235468712', false],
            ['539290859', false],
            ['1041447700', false],
        ];
    }
}
