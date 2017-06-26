<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorE1Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'E1'));

        $this->validator = new ValidatorE1($bank);
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
            ['0100041104', true],
            ['0100054106', true],
            ['0200025107', true],

            ['0150013107', false],
            ['0200035101', false],
            ['0081313890', false],
            ['4268550840', false],
            ['0987402008', false],
        ];
    }
}
