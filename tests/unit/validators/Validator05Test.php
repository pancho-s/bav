<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator05Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '05'));

        $this->validator = new Validator05($bank);
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
            ['707332', true],
            ['715450', true],
            ['20602488', true],
            ['74451368', true],

            ['707333', false],
            ['715451', false],
            ['20602489', false],
            ['74451369', false],
        ];
    }
}
