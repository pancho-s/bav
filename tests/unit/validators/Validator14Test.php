<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator14Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '14'));

        $this->validator = new Validator14($bank);
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
            ['0002212269', true],
            ['0005405858', true],
            ['0005534550', true],
            ['0102385015', true],

            ['0002212260', false],
            ['0005405859', false],
            ['0005534551', false],
            ['0102385016', false],
        ];
    }
}
