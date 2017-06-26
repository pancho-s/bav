<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorE2Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'E2'));

        $this->validator = new ValidatorE2($bank);
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
            ['0003831745', true],
            ['0051330335', true],
            ['1730773457', true],
            ['1987654327', true],
            ['2012345675', true],
            ['2220467998', true],
            ['3190519693', true],
            ['3011219713', true],
            ['4131220086', true],
            ['4110919419', true],
            ['5000083836', true],
            ['5069696965', true],

            ['0121314151', false],
            ['0036958466', false],
            ['1000174716', false],
            ['1975312468', false],
            ['2260519349', false],
            ['2004002175', false],
            ['3780024149', false],
            ['3015024274', false],
            ['4968745438', false],
            ['4005012150', false],
            ['5000137454', false],
            ['5221398871', false],
            ['6221398879', false],
            ['6742185327', false],
            ['7793867322', false],
            ['7900695413', false],
            ['8001256238', false],
            ['8303808900', false],
            ['9703805111', false],
            ['9006126433', false],
        ];
    }
}
