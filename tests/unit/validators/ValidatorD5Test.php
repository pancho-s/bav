<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorD5Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'D5'));

        $this->validator = new ValidatorD5($bank);
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
            // Variant 1
            ['5999718138', true],
            ['1799222116', true],
            ['0099632004', true],

            ['3299632008', false],
            ['1999204293', false],
            ['0399242139', false],

            // Variant 2
            ['0004711173', true],
            ['0007093330', true],
            ['0000127787', true],

            ['8623420004', false],
            ['0001123458', false],

            // Variant 3
            ['0004711172', true],
            ['0007093335', true],

            ['0001123458', false],

            // Variant 4
            ['0000100062', true],
            ['0000100088', true],
            ['8623410000', true],

            ['0000100084', false],
            ['0000100085', false],
        ];
    }
}
