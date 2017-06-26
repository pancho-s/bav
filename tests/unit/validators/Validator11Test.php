<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator11Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '11'));

        $this->validator = new Validator11($bank);
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
            ['769010', true],
            ['3059227', true],
            ['5661730', true],
            ['7547927', true],

            ['769011', false],
            ['3059228', false],
            ['5661731', false],
            ['7547928', false],
        ];
    }
}
