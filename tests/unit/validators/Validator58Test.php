<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator58Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '58'));

        $this->validator = new Validator58($bank);
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
            ['1800881120', true],
            ['9200654108', true],
            ['1015222224', true],
            ['3703169668', true],

            ['1800881121', false],
            ['9200654109', false],
            ['1015222225', false],
            ['3703169669', false],
        ];
    }
}
