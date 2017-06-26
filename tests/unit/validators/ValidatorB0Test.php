<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorB0Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'B0'));

        $this->validator = new ValidatorB0($bank);
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
            ['1197423162', true],
            ['1000000606', true],

            // variant one
            ['8137423260', false],
            ['600000606', false],
            ['51234309', false],

            // variant two
            ['1000000406', true],
            ['1035791538', true],
            ['1126939724', true],
            ['1197423460', true],

            // variant two
            ['1000000405', false],
            ['1035791539', false],
            ['8035791532', false],
            ['535791830', false],
            ['51234901', false],
        ];
    }
}
