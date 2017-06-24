<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator76Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '76'));

        $this->validator = new Validator76($bank);
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
            ['0006543200', true],
            ['9012345600', true],
            ['7876543100', true],

            ['0006543300', false],
            ['9012345700', false],
            ['7876543200', false],
        ];
    }
}
