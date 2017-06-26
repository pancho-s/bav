<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorD1Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'D1'));

        $this->validator = new ValidatorD1($bank);
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
            ['0082012203', true],
            ['1452683581', true],
            ['2129642505', true],
            ['3002000027', true],
            ['4230001407', true],
            ['5000065514', true],
            ['6001526215', true],
            ['7126502149', true],
            ['9000430223', true],

            ['0000260986', false],
            ['1062813622', false],
            ['2256412314', false],
            ['3012084101', false],
            ['4006003027', false],
            ['5814500990', false],
            ['6128462594', false],
            ['7000062035', false],
            ['8003306026', false],
            ['9000641509', false],
        ];
    }
}
