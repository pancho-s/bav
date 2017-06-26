<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorA5Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'A5'));

        $this->validator = new ValidatorA5($bank);
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
            ['9941510001', true],
            ['9961230019', true],
            ['9380027210', true],
            ['9932290910', true],

            // variant one
            ['9941510002', false],
            ['9961230020', false],

            // variant two
            ['0000251437', true],
            ['0007948344', true],
            ['0000159590', true],
            ['0000051640', true],

            // variant two
            ['0000251438', false],
            ['0007948345', false],
        ];
    }
}
