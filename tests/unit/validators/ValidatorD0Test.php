<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorD0Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'D0'));

        $this->validator = new ValidatorD0($bank);
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
            ['6100272324', true],
            ['6100273479', true],

            ['6100272885', false],
            ['6100273377', false],
            ['6100274012', false],

            // Variant 2
            ['5700000000', true],
            ['5700000001', true],
            ['5799999998', true],
            ['5799999999', true],

            ['5699999999', false],
            ['5800000000', false],
        ];
    }
}
