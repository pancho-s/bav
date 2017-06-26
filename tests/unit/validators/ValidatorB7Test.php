<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorB7Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'B7'));

        $this->validator = new ValidatorB7($bank);
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
            ['0700001529', true],
            ['0730000019', true],
            ['0001001008', true],
            ['0001057887', true],
            ['0001007222', true],
            ['0810011825', true],
            ['0800107653', true],
            ['0005922372', true],

            // variant one
            ['0001057886', false],
            ['0003815570', false],
            ['0005620516', false],
            ['0740912243', false],
            ['0893524479', false],

            // variant two
            ['999999', true],
            ['6000000', true],
            ['699999999', true],
            ['900000000', true],
        ];
    }
}
