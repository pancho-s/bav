<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorA6Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'A6'));

        $this->validator = new ValidatorA6($bank);
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
            ['800048548', true],
            ['0855000014', true],
            ['17', true],
            ['55300030', true],
            ['150178033', true],
            ['600003555', true],
            ['900291823', true],

            ['860000817', false],
            ['810033652', false],
            ['305888', false],
            ['200071280', false],
        ];
    }
}
