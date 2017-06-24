<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator87Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '87'));

        $this->validator = new Validator87($bank);
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
            ['0000000406', true],
            ['0000051768', true],
            ['0010701590', true],
            ['0010720185', true],

            // method A
            ['0000000407', false],
            ['0000051769', false],
            ['0010701591', false],
            ['0010720195', false],

            // method B and C
            ['0000100005', true],
            ['0000393814', true],
            ['0000950360', true],
            ['3199500501', true],

            // method B and C
            ['0000100006', false],
            ['0000393815', false],
            ['0000950361', false],
            ['3199500502', false],

            // method D
            ['0001975641', true],
            ['0001988654', true],

            // method D
            ['0001924592', false],
        ];
    }
}
