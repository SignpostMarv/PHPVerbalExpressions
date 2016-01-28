<?php
/**
* @author SignpostMarv
*/

use VerbalExpressions\PHPVerbalExpressions\VerbalExpressions;


class DynamicallyGeneratedTest
    extends
        PHPUnit_Framework_TestCase
{

    public function parseTests() {
        $out = array();
        $directory = realpath(dirname(__DIR__) . '/vendor/signpostmarv/verbal-expressions-tests/tests');
        if (is_dir($directory)) {
            $testFiles = array_map(
                function($filePath) {
                    return json_decode(file_get_contents($filePath));
                },
                array_filter(
                    array_map(
                        function($filePath) {
                            return realpath($filePath);
                        },
                        glob($directory . '/*.json')
                    ),
                    function ($filePath) use($directory) {
                        return (
                            !!$filePath &&
                            is_readable($filePath) &&
                            strpos($filePath, $directory) === 0
                        );
                    }
                )
            );
            foreach ($testFiles as $testJson) {
                foreach ($testJson->tests as $test) {
                    $out[] = array(
                        $test->name,
                        $test->description,
                        $test->output,
                        $test->callStack
                    );
                }
            }
        }
        return $out;
    }

    /**
    * @dataProvider parseTests
    */
    public function testTests(
        $testName,
        $testDescription,
        $testOutput,
        $testCallStack
    ){
        $this->setName($testName);
        $output = $testOutput->default;
        if (isset($testOutput->php)) {
            $output = $testOutput->php;
        }
        $regex = new VerbalExpressions();
        $returnValue = null;
        foreach ($testCallStack as $testCall) {
            $this->assertTrue(method_exists($regex, $testCall->method));
            $returnValue = call_user_func_array(
                array(
                    $regex,
                    $testCall->method
                ),
                $testCall->arguments
            );
            if ($testCall->returnType === 'sameInstance') {
                $this->assertInstanceOf(get_class($regex), $returnValue);
                $this->assertTrue($regex === $returnValue);
                $regex = $returnValue;
            } else {
                $this->assertEquals(
                    $testCall->returnType,
                    gettype($returnValue)
                );
            }
        }
        $this->assertEquals($output, $returnValue);
    }
}
