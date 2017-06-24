<?php

namespace malkusch\bav;


use PHPUnit\Framework\TestCase;

class Validator03Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '03'));

        $this->validator = new Validator03($bank);
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
            ['10627894', true],
            ['10635582', true],
            ['11091519', true],
            ['0011578088', true],

            ['10627895', false],
            ['10635583', false],
            ['11091510', false],
            ['0011578089', false],
        ];
    }
}
