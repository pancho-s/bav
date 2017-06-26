<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorA1Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'A1'));

        $this->validator = new ValidatorA1($bank);
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
            ['0010030005', true],
            ['0010030997', true],
            ['1010030054', true],

            ['0110030005', false],
            ['0010030998', false],
            ['0000030005', false],
        ];
    }
}
