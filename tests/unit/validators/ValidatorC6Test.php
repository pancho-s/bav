<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorC6Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'C6'));

        $this->validator = new ValidatorC6($bank);
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
            ['0000065516', true],
            ['0203178249', true],
            ['1031405209', true],
            ['1082012201', true],
            ['2003455189', true],
            ['2004001016', true],
            ['3110150986', true],
            ['3068459207', true],
            ['5035105948', true],
            ['5286102149', true],
            ['4012660028', true],
            ['4100235626', true],
            ['6028426119', true],
            ['6861001755', true],
            ['7008199027', true],
            ['7002000023', true],
            ['8526080015', true],
            ['8711072264', true],
            ['9000430223', true],
            ['9000781153', true],

            ['0525111212', false],
            ['0091423614', false],
            ['1082311275', false],
            ['1000118821', false],
            ['2004306518', false],
            ['2016001206', false],
            ['3462816371', false],
            ['3622548632', false],
            ['4232300158', false],
            ['4000456126', false],
            ['5002684526', false],
            ['5564123850', false],
            ['6295473774', false],
            ['6640806317', false],
            ['7000062022', false],
            ['7006003027', false],
            ['8348300002', false],
            ['8654216984', false],
            ['9000641509', false],
            ['9000260986', false],
        ];
    }
}
