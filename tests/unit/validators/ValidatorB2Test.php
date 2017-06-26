<?php

namespace malkusch\bav;

use PHPUnit\Framework\TestCase;

class ValidatorB2Test extends TestCase
{
    private $validator;

    public function setUp()
    {
        parent::setUp();

        $backend = $this->createMock("malkusch\bav\FileDataBackend");
        $bank = $this->createMock(
            "malkusch\bav\Bank", array(), array($backend, 1, 'B2'));

        $this->validator = new ValidatorB2($bank);
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
            ['0020012357', true],
            ['0080012345', true],
            ['0926801910', true],
            ['1002345674', true],

            // variant one
            ['0020012399', false],
            ['0080012347', false],
            ['0080012370', false],
            ['0932100027', false],
            ['3310123454', false],

            // variant two
            ['8000990054', true],
            ['9000481805', true],

            // variant two
            ['8000990057', false],
            ['8011000126', false],
            ['9000481800', false],
            ['9980480111', false],
        ];
    }
}
