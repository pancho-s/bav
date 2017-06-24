<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator66Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '66'));

        $this->validator = new Validator66($bank);
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
            ['100154508', true],
            ['101154508', true],
            ['100154516', true],
            ['101154516', true],

            ['100154509', false],
            ['101154509', false],
            ['100154517', false],
            ['101154517', false],
        ];
    }
}
