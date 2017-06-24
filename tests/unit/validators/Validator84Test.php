<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator84Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '84'));

        $this->validator = new Validator84($bank);
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
            // method A
            ['240699', true],
            ['350982', true],
            ['461059', true],

            // method B
            ['240692', true],
            ['350985', true],
            ['461052', true],

            // method C
            ['240961', true],
            ['350984', true],
            ['461054', true],

            // exceptions - calculation as exceptions in validator 51
            ['0199100002', true],
            ['0099100010', true],
            ['2599100002', true],
            ['0199100004', true],
            ['2599100003', true],
            ['3199204090', true],

            // exceptions - calculation as exceptions in validator 51
            ['0099345678', false],
            ['0099345678', false],
            ['0099100110', false],
            ['0199100040', false],

            // wrong for all calculations
            ['240965', false],
            ['350980', false],
            ['461053', false],
        ];
    }
}
