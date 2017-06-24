<?php

namespace malkusch\bav;


class Validator41Test extends \PHPUnit_Framework_TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '41'));

        $this->validator = new Validator41($bank);
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
            ['4013410024', true],
            ['4016660195', true],
            ['0166805317', true],
            ['4019310079', true],
            ['4019340829', true],
            ['4019151002', true],

            ['4013410025', false],
            ['4016660196', false],
            ['0166805318', false],
            ['4019310070', false],
            ['4019340820', false],
            ['4019151003', false],
        ];
    }
}
