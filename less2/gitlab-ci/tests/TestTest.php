<?php

use PHPUnit\Framework\TestCase;

class TestTest extends TestCase
{
    public function testSayHello()
    {
        $test = new Test();
        $this->assertEquals("Hello Test Gitlab", $test->sayHello());
    }
}