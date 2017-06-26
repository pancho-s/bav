<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorA7Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'A7'));

        $this->validator = new ValidatorA7($bank);
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
            ['19010008', true],
            ['19010438', true],

            // variant one
            ['209010893', false],

            // variant two
            ['19010660', true],
            ['19010876', true],
            ['209010892', true],

            // variant two
            ['209010893', false],
        ];
    }
}
