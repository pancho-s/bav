<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorC2Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'C2'));

        $this->validator = new ValidatorC2($bank);
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
            ['2394871426', true],
            ['4218461950', true],
            ['7352569148', true],

            ['0328705282', false],
            ['9024675131', false],

            // Variant 2
            ['5127485166', true],
            ['8738142564', true],
        ];
    }
}
