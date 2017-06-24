<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator90Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '90'));

        $this->validator = new Validator90($bank);
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
            ['0001975641', true],
            ['0001988654', true],

            // method A
            ['0001924592', false],

            // method B
            ['0001863530', true],
            ['0001784451', true],

            // method B
            ['0000901568', false],

            // method C
            ['0000654321', true],
            ['0000824491', true],

            // method C
            ['0000820487', false],

            // method D
            ['0000677747', true],
            ['0000840507', true],

            // method D
            ['0000726393', false],

            // method E
            ['0000996663', true],
            ['0000666034', true],

            // method E
            ['0000924591', false],

            // method F
            ['0099100002', true],

            // method F
            ['0099100007', false],

            // method G
            ['0004923250', true],
            ['0003865960', true],

            // method G
            ['0003865964', false],
        ];
    }
}
