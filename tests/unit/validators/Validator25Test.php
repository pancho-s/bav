<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator25Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '25'));

        $this->validator = new Validator25($bank);
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
            ['201189283', true],
            ['215160754', true],
            ['260322814', true],

            ['201189284', false],
            ['215160755', false],
            ['260322815', false],
        ];
    }
}
