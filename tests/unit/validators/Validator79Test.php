<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator79Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '79'));

        $this->validator = new Validator79($bank);
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
            ['3230012688', true],
            ['4230028872', true],
            ['5440001898', true],
            ['6330001063', true],
            ['7000149349', true],
            ['8000003577', true],
            ['1550167850', true],
            ['9011200140', true],

            ['3230012689', false],
            ['4230028873', false],
            ['5440001899', false],
            ['6330001064', false],
            ['7000149340', false],
            ['8000003578', false],
            ['1550167860', false],
            ['9011200150', false],
        ];
    }
}
