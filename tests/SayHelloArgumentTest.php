<?php


use PHPUnit\Framework\TestCase;

class SayHelloArgumentTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input,$expected)
    {
        $this->assertEquals($expected,sayHelloArgument($input));
    }

    public function positiveDataProvider()
    {
        return [
            [666,'Hello 666'],
            ['345','Hello 345'],
            ['mommy','Hello mommy'],
            [true,'Hello 1'],
        ];
    }
}