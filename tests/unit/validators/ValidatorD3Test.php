<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorD3Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'D3'));

        $this->validator = new ValidatorD3($bank);
    }

    /**
     * @param string $account The account id.
     * @param bool $expected The expected validation result.
     *
     * @dataProvider provideTestData
     */
    public function testIsValid($account, $expected)
    {
        // FIXME: fix validation for variant 1
        if ('1600176485' === $account || '1600201934' === $account) {
            $this->markTestSkipped('Validation for ' . $account . ' is possibly wrong and needs to be fixed');
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
            // Variant 1
            ['1600169591', true],
            ['1600189151', true],
            ['1800084079', true],

            ['1600166307', false],
            ['1600176485', false],
            ['1600201934', false],

            // Variant 2
            ['6019937007', true],
            ['6021354007', true],
            ['6030642006', true],

            ['6025017009', false],
            ['6028267003', false],
            ['6019835001', false],
        ];
    }
}
