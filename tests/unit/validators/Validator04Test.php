<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator04Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '04'));

        $this->validator = new Validator04($bank);
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
            ['452424', true],
            ['26038154', true],
            ['100074389', true],
            ['100272431', true],

            ['452425', false],
            ['26038155', false],
            ['100074380', false],
            ['100272432', false],
        ];
    }
}
