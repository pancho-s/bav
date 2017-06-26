<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class Validator32Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, '32'));

        $this->validator = new Validator32($bank);
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
            ['9141405', true],
            ['1709107983', true],
            ['0122116979', true],
            ['0121114867', true],
            ['9030101192', true],
            ['9245500460', true],

            ['9141406', false],
            ['1709107984', false],
            ['0122116970', false],
            ['0121114868', false],
            ['9030101193', false],
            ['9245500461', false],
        ];
    }
}
