<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator24Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '24'));

        $this->validator = new Validator24($bank);
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
            ['138301', true],
            ['2654808', true],
            ['6654802', true],
            ['0008312466', true],

            ['138302', false],
            ['2654809', false],
            ['6654803', false],
            ['0008312467', false],
        ];
    }
}
