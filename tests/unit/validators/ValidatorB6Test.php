<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;
use Prophecy\Exception\Exception;
use spec\Prophecy\Argument\Token\ExactValueTokenSpec;

class ValidatorB6Test extends TestCase
{
    private $bank;

    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $this->bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'B6'));

        $this->validator = new ValidatorB6($this->bank);
    }

    /**
     * @param string $account The account id.
     * @param bool $expected The expected validation result.
     * @param int $bankId
     *
     * @dataProvider provideTestData
     */
    public function testIsValid($account, $expected, $bankId = 1)
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
            ['9110000000', true],
            ['0269876545', true],

            ['9111000000', false],
            ['0269456780', false],

            // Variant 2
            ['487310018', true, '80053782'],

            ['467310018', false, '80053762'],
            ['477310018', false, '80053772'],
        ];
    }
}
