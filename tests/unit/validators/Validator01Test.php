<?php

namespace malkusch\bav;


class Validator01Test extends \PHPUnit_Framework_TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '01'));

        $this->validator = new Validator01($bank);

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
            ['725938', true],
            ['745420', true],
            ['7870026509', true],
            ['0019191924', true],

            ['725939', false],
            ['745421', false],
            ['7870026500', false],
            ['0019191925', false],
        ];
    }
}
