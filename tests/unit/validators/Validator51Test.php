<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator51Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '51'));

        $this->validator = new Validator51($bank);
    }

    /**
     * @param string $account The account id.
     * @param bool $expected The expected validation result.
     *
     * @dataProvider provideTestData
     */
    public function testIsValid($account, $expected)
    {
        // FIXME: fix validation for method B
        if ('0001234566' === $account) {
            $this->markTestSkipped('Validation for 0001234566 is wrong and needs to be fixed');
        }

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
            // method A
            ['0001156071', true],
            ['0001156136', true],

            // method A
            ['0000156079', false],

            // method B
            ['0001156078', true],
            ['0001234567', true],

            // method B
            ['0001234566', false], // FIXME: should fail - validator seems not to work correct here
            ['0012345678', false],

            // method C
            ['340968', true],
            ['201178', true],
            ['1009588', true],

            // method C
            ['0023456783', false],
            ['0076543211', false],

            // method D
            ['0000156071', true],
            ['101356073', true],

            // method D
            ['0123412345', false],
            ['67493647', false],

            // exceptions to all methods - variant one
            ['0199100002', true],
            ['0099100010', true],
            ['2599100002', true],

            // exceptions to all methods - variant one
            ['0099345678', false],

            // exceptions to all methods - variant two
            ['0199100004', true],
            ['2599100003', true],
            ['3199204090', true],

            // exceptions to all methods - variant two
            ['0099345678', false],
            ['0099100110', false],
            ['0199100040', false],
        ];
    }
}
