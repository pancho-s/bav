<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorB3Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'B3'));

        $this->validator = new ValidatorB3($bank);
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
            // variant one
            ['1000000060', true],
            ['0000000140', true],
            ['0000000019', true],
            ['1002798417', true],
            ['8409915001', true],

            // variant one
            ['0002799899', false],
            ['1000000111', false],

            // variant two
            ['9635000101', true],
            ['9730200100', true],

            // variant two
            ['9635100101', false],
            ['9730300100', false],
        ];
    }
}
