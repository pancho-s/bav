<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorB5Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'B5'));

        $this->validator = new ValidatorB5($bank);
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
            ['0159006955', true],
            ['2000123451', true],
            ['1151043216', true],
            ['9000939033', true],

            // variant one
            ['7414398260', false],
            ['8347251693', false],
            ['2345678901', false],
            ['5678901234', false],
            ['9000293707', false],

            // variant two
            ['0123456782', true],
            ['0130098767', true],
            ['1045000252', true],
            ['1151043211', true],

            // variant two
            ['0159004165', false],
            ['0023456787', false],
            ['0056789018', false],
            ['3045000333', false],
        ];
    }
}
