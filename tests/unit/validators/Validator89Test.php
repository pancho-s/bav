<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator89Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '89'));

        $this->validator = new Validator89($bank);
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
            ['1098506', true],
            ['32028008', true],
            ['218433000', true],

            ['1098507', false],
            ['32028009', false],
            ['218433001', false],
        ];
    }
}
