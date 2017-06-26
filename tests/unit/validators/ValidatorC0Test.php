<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;
use Prophecy\Exception\Exception;
use spec\Prophecy\Argument\Token\ExactValueTokenSpec;

class ValidatorC0Test extends TestCase
{
    private $bank;

    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $this->bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'C0'));

        $this->validator = new ValidatorC0($this->bank);
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
            // Variant 1
            ['43001500', true, '13051172'],
            ['48726458', true, '13051172'],

            ['29837521', false, '13051172'],

            // Variant 2
            ['0082335729', true, '13051172'],
            ['0734192657', true, '13051172'],
            ['6932875274', true, '13051172'],

            ['0132572975', false, '13051172'],
            ['3038752371', false, '13051172'],

            // Data from accounts.json
            ['42279904', true, '81053272'],
            ['48074470', true, '81053272'],
            ['49279640', true, '81053272'],
            ['0082335729', true, '81053272'],
            ['0734192657', true, '81053272'],
            ['6932875274', true, '81053272'],

            ['0132572975', false, '86055462'],
            ['3038752371', false, '86055462'],
        ];
    }
}
