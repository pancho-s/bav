<?php

namespace malkusch\bav;


class Validator52Test extends \PHPUnit_Framework_TestCase
{
    private $bank;

    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $this->bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '52'));

        $this->validator = new Validator52($this->bank);
    }

    /**
     * @param string $account The account id.
     * @param bool $expected The expected validation result.
     * @param int $bankId
     *
     * @dataProvider provideTestData
     */
    public function testIsValid($account, $expected, $bankId)
    {
        $this->bank->method('getBankID')->willReturn($bankId);

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
            ['43001500', true, '13051172'],

            ['43001499', false, '13051172'],
            ['43001501', false, '13051172'],
            ['43001500', false, '13051171'],
            ['43001500', false, '13051173'],
        ];
    }
}
