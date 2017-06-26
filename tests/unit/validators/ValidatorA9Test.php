<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorA9Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'A9'));

        $this->validator = new ValidatorA9($bank);
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
            ['5043608', true],
            ['86725', true],

            // variant one
            ['86724', false],

            // variant two
            ['504360', true],
            ['822035', true],
            ['32577083', true],

            // variant two
            ['86724', false],
            ['292497', false],
            ['30767208', false],
        ];
    }
}
