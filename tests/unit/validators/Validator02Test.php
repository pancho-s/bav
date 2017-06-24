<?php

namespace malkusch\bav;


use PHPUnit\Framework\TestCase;

class Validator02Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '02'));

        $this->validator = new Validator02($bank);
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
            ['837547', true],
            ['1207253', true],
            ['206110073', true],
            ['228036623', true],
            ['281042020', true],

            ['837548', false],
            ['1207254', false],
            ['206110074', false],
            ['228036624', false],
            ['281042021', false],
        ];
    }
}
