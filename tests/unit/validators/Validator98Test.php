<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator98Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '98'));

        $this->validator = new Validator98($bank);
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
            ['9619439213', true],
            ['3009800016', true],
            ['9619509976', true],
            ['5989800173', true],
            ['9619319999', true],
            ['6719430018', true],

            ['9619439214', false],
            ['3009800017', false],
            ['9619509977', false],
            ['5989800183', false],
            ['9619319990', false],
            ['6719430019', false],
        ];
    }
}
