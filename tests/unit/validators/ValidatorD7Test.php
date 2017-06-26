<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorD7Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'D7'));

        $this->validator = new ValidatorD7($bank);
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
            ['0500018205', true],
            ['0230103715', true],
            ['0301000434', true],
            ['0330035104', true],
            ['0420001202', true],
            ['0134637709', true],
            ['0201005939', true],
            ['0602006999', true],

            ['0501006102', false],
            ['0231307867', false],
            ['0301005331', false],
            ['0330034104', false],
            ['0420001302', false],
            ['0135638809', false],
            ['0202005939', false],
            ['0601006977', false],
        ];
    }
}
