<?php

namespace malkusch\bav;


class Validator49Test extends \PHPUnit_Framework_TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '49'));

        $this->validator = new Validator49($bank);
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
            ['1121799', true],
            ['1444160', true],
            ['1826128', true],
            ['2195865', true],

            ['1121790', false],
            ['1444161', false],
            ['1826129', false],
            ['2195866', false],
        ];
    }
}
