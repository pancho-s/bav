<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorC5Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'C5'));

        $this->validator = new ValidatorC5($bank);
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
            // Variant 1
            ['0000301168', true],
            ['0000302554', true],
            ['0300020050', true],
            ['0300566000', true],

            ['0000302589', false],
            ['0000507336', false],
            ['0302555000', false],
            ['0302589000', false],

            // Variant 2
            ['1000061378', true],
            ['1000061412', true],
            ['4450164064', true],
            ['4863476104', true],
            ['5000000028', true],
            ['5000000391', true],
            ['6450008149', true],
            ['6800001016', true],
            ['9000100012', true],
            ['9000210017', true],

            ['1000061457', false],
            ['1000061498', false],
            ['4864446015', false],
            ['4865038012', false],
            ['5000001028', false],
            ['5000001075', false],
            ['6450008150', false],
            ['6542812818', false],
            ['9000110012', false],
            ['9000300310', false],

            // Variant 3
            ['3060188103', true],
            ['3070402023', true],

            ['3081000783', false],
            ['3081308871', false],

            // Variant 4
            ['7000000000', true],
            ['7000000001', true],
            ['7099999998', true],
            ['7099999999', true],
            ['8500000000', true],
            ['8500000001', true],
            ['8599999998', true],
            ['8599999999', true],

            ['6999999999', false],
            ['7100000000', false],
            ['8499999999', false],
            ['8600000000', false],
        ];
    }
}
