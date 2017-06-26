<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator26Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '26'));

        $this->validator = new Validator26($bank);
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
            ['0520309001', true],
            ['1111118111', true],
            ['0005501024', true],

            ['0520409001', false],
            ['1111119111', false],
            ['0005502024', false],
        ];
    }
}
