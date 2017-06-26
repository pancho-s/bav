<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorC8Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'C8'));

        $this->validator = new ValidatorC8($bank);
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
            ['3456789019', true],
            ['5678901231', true],

            ['1234567890', false],
            ['9012345678', false],

            // Variant 2
            ['3456789012', true],
            ['0022007130', true],

            // Variant 3
            ['0123456789', true],
            ['0552071285', true],
        ];
    }
}
