<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator35Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '35'));

        $this->validator = new Validator35($bank);
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
            ['0000108443', true],
            ['0000107451', true],
            ['0000102921', true],
            ['0000102349', true],
            ['0000101709', true],
            ['0000101599', true],

            ['0000108444', false],
            ['0000107452', false],
            ['0000102922', false],
            ['0000102340', false],
            ['0000101700', false],
            ['0000101590', false],
        ];
    }
}
