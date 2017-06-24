<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator88Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '88'));

        $this->validator = new Validator88($bank);
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
            ['2525259', true],
            ['1000500', true],
            ['90013000', true],
            ['92525253', true],
            ['99913003', true],

            ['2525250', false],
            ['1000501', false],
            ['90013001', false],
            ['92525254', false],
            ['99913004', false],
        ];
    }
}
