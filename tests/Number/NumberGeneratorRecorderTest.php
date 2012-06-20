<?php
/**
 * Unit tests for NumberGeneratorRecorder class
 */
use nicmart\Random\Number\PhpNumberGenerator;
use nicmart\Random\Number\NumberGeneratorRecorder;

class NumberGeneratorRecorderTest extends PHPUnit_Framework_TestCase
{
    public function testConstructorAndGetGenerator()
    {
        $generator = new PhpNumberGenerator;
        $recorder = new NumberGeneratorRecorder($generator);
        $this->assertEquals($generator, $recorder->getNumberGenerator());
    }

    public function testRecordedNumbers()
    {
        $generator = new PhpNumberGenerator;
        $recorder = new NumberGeneratorRecorder($generator);

        for ($i = 1; $i <= 20; $i++) {
            $numbers[] = $recorder->rand(1, 100);
        }

        $this->assertEquals($numbers, $recorder->getRecording());
    }
}

