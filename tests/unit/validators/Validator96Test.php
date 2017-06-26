<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator96Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '96'));

        $this->validator = new Validator96($bank);
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
            // variant one
            ['0000254100', true],
            ['9421000009', true],

            // variant one
            ['0000254101', false],
            ['9421000000', false],

            // variant two
            ['0000000208', true],
            ['0101115152', true],
            ['0301204301', true],

            // variant two
            ['0000000209', false],
            ['0101115153', false],
            ['0301204302', false],

            // variant three
            ['0001300000', true],
            ['0099399999', true],

            // variant three
            // took 0001299998 because 0001299999 would be valid be one of the other variants
            ['0001299998', false],
            ['0099400000', false],
        ];
    }
}
