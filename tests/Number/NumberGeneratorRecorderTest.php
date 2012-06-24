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
        $this->assertEquals($generator, $recorder->getRecordedGenerator());
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

    public function testPlay()
    {
        $generator = new PhpNumberGenerator;
        $recorder = new NumberGeneratorRecorder($generator);

        for ($i = 1; $i <= 5; $i++) {
            $numbers[] = $recorder->rand(1, 100);
        }

        $recorder->play();

        for ($i = 1; $i <= 10; $i++) {
            $this->assertEquals($numbers[(($i - 1) % 5)], $recorder->rand(1, 100));
        }
    }

    public function testStop()
    {
        $generator = new PhpNumberGenerator;
        $recorder = new NumberGeneratorRecorder($generator);

        $n = $recorder->rand(1, 10);
        $recorder->stop();
        $recorder->rand(1, 10);

        $this->assertEquals(array($n), $recorder->getRecording());
    }

    public function testRecord()
    {
        $generator = new PhpNumberGenerator;
        $recorder = new NumberGeneratorRecorder($generator);

        $n = $recorder->rand(1, 10);
        $recorder->stop();
        $recorder->record();
        $m = $recorder->rand(1, 10);

        $this->assertEquals(array($n, $m), $recorder->getRecording());
    }
}

