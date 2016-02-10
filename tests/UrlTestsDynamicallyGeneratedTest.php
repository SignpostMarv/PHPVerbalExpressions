<?php

namespace VerbalExpressions\PHPVerbalExpressions\Tests;

use PHPUnit_Framework_TestCase;
use VerbalExpressions\PHPVerbalExpressions\VerbalExpressions;

class UrlTestsDynamicallyGeneratedTest extends PHPUnit_Framework_TestCase
{
    const VerbExpClassName = 'VerbalExpressions\\PHPVerbalExpressions\\VerbalExpressions';
    /**
     * Build URL Pattern
     */
    protected function patternBuildUrlPattern()
    {
        $regex = new VerbalExpressions();
        $out = $regex->startOfLine();
        $this->assertInstanceOf(static::VerbExpClassName, $out);
        $regex = $out;
        $out = $regex->then('http');
        $this->assertInstanceOf(static::VerbExpClassName, $out);
        $regex = $out;
        $out = $regex->maybe('s');
        $this->assertInstanceOf(static::VerbExpClassName, $out);
        $regex = $out;
        $out = $regex->then('://');
        $this->assertInstanceOf(static::VerbExpClassName, $out);
        $regex = $out;
        $out = $regex->maybe('www.');
        $this->assertInstanceOf(static::VerbExpClassName, $out);
        $regex = $out;
        $out = $regex->anythingBut(' ');
        $this->assertInstanceOf(static::VerbExpClassName, $out);
        $regex = $out;
        $out = $regex->endOfLine();
        $this->assertInstanceOf(static::VerbExpClassName, $out);
        $regex = $out;
        return $regex;
    }
    /**
     * Test URLs
     */
    public function testTestURLs()
    {
        $regex = static::patternBuildUrlPattern();
        $this->assertInstanceOf(static::VerbExpClassName, $regex);
        $out = $regex->test('http://github.com');
        $this->assertEquals('boolean', gettype($out));
        $this->assertEquals(true, $out);
    }
    /**
     * Test URLs
     */
    public function testTestURLs2()
    {
        $regex = static::patternBuildUrlPattern();
        $this->assertInstanceOf(static::VerbExpClassName, $regex);
        $out = $regex->test('http://www.github.com');
        $this->assertEquals('boolean', gettype($out));
        $this->assertEquals(true, $out);
    }
    /**
     * Test URLs
     */
    public function testTestURLs3()
    {
        $regex = static::patternBuildUrlPattern();
        $this->assertInstanceOf(static::VerbExpClassName, $regex);
        $out = $regex->test('https://github.com');
        $this->assertEquals('boolean', gettype($out));
        $this->assertEquals(true, $out);
    }
    /**
     * Test URLs
     */
    public function testTestURLs4()
    {
        $regex = static::patternBuildUrlPattern();
        $this->assertInstanceOf(static::VerbExpClassName, $regex);
        $out = $regex->test('https://www.github.com');
        $this->assertEquals('boolean', gettype($out));
        $this->assertEquals(true, $out);
    }
    /**
     * Test URLs
     */
    public function testTestURLs5()
    {
        $regex = static::patternBuildUrlPattern();
        $this->assertInstanceOf(static::VerbExpClassName, $regex);
        $out = $regex->test('https://github.com/blog');
        $this->assertEquals('boolean', gettype($out));
        $this->assertEquals(true, $out);
    }
    /**
     * Test URLs
     */
    public function testTestURLs6()
    {
        $regex = static::patternBuildUrlPattern();
        $this->assertInstanceOf(static::VerbExpClassName, $regex);
        $out = $regex->test('https://foobar.github.com');
        $this->assertEquals('boolean', gettype($out));
        $this->assertEquals(true, $out);
    }
    /**
     * Test URLs
     */
    public function testTestURLs7()
    {
        $regex = static::patternBuildUrlPattern();
        $this->assertInstanceOf(static::VerbExpClassName, $regex);
        $out = $regex->test(' http://github.com');
        $this->assertEquals('boolean', gettype($out));
        $this->assertEquals(false, $out);
    }
    /**
     * Test URLs
     */
    public function testTestURLs8()
    {
        $regex = static::patternBuildUrlPattern();
        $this->assertInstanceOf(static::VerbExpClassName, $regex);
        $out = $regex->test('foo');
        $this->assertEquals('boolean', gettype($out));
        $this->assertEquals(false, $out);
    }
    /**
     * Test URLs
     */
    public function testTestURLs9()
    {
        $regex = static::patternBuildUrlPattern();
        $this->assertInstanceOf(static::VerbExpClassName, $regex);
        $out = $regex->test('htps://github.com');
        $this->assertEquals('boolean', gettype($out));
        $this->assertEquals(false, $out);
    }
    /**
     * Test URLs
     */
    public function testTestURLs10()
    {
        $regex = static::patternBuildUrlPattern();
        $this->assertInstanceOf(static::VerbExpClassName, $regex);
        $out = $regex->test('http:/github.com');
        $this->assertEquals('boolean', gettype($out));
        $this->assertEquals(false, $out);
    }
    /**
     * Test URLs
     */
    public function testTestURLs11()
    {
        $regex = static::patternBuildUrlPattern();
        $this->assertInstanceOf(static::VerbExpClassName, $regex);
        $out = $regex->test('https://github.com /blog');
        $this->assertEquals('boolean', gettype($out));
        $this->assertEquals(false, $out);
    }
}
