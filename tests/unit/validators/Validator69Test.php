<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator69Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '69'));

        $this->validator = new Validator69($bank);
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
            ['1234567900', true],

            // variant two
            ['1234567006', true],

            // variant one
            ['1234567000', false],

            // variant two
            ['1234567007', false],
        ];
    }
}
