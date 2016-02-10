<?php

namespace VerbalExpressions\PHPVerbalExpressions\Tests;

use PHPUnit_Framework_TestCase;
use VerbalExpressions\PHPVerbalExpressions\VerbalExpressions;
class GetRegexDynamicallyGeneratedTest extends PHPUnit_Framework_TestCase
{
    const VerbExpClassName = 'VerbalExpressions\\PHPVerbalExpressions\\VerbalExpressions';
    /**
     * Test getRegex
     */
    public function testGetRegex()
    {
        $regex = new VerbalExpressions();
        $out = $regex->startOfLine();
        $this->assertInstanceOf(static::VerbExpClassName, $out);
        $regex = $out;
        $out = $regex->range(0, 9, 'a', 'z', 'A', 'Z');
        $this->assertInstanceOf(static::VerbExpClassName, $out);
        $regex = $out;
        $out = $regex->multiple('');
        $this->assertInstanceOf(static::VerbExpClassName, $out);
        $regex = $out;
        $out = $regex->getRegex();
        $this->assertEquals('string', gettype($out));
        $this->assertEquals('/^[0-9a-zA-Z]+/m', $out);
    }
}