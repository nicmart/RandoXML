<?php
/**
 * Unit tests for NumberGeneratorRecorder class
 */
use nicmart\Random\Number\CyclicNumberGenerator;

class CyclicNumberGeneratorTest extends PHPUnit_Framework_TestCase
{
   public function testRand()
   {
       $generator = new CyclicNumberGenerator(array(4, 9, 13, 20, 18));

       $this->assertEquals(4, $generator->rand(1,100));
       $this->assertEquals(9, $generator->rand(1,100));
       $this->assertEquals(13, $generator->rand(1,100));
       $this->assertEquals(20, $generator->rand(1,100));
       $this->assertEquals(18, $generator->rand(1,100));
       $this->assertEquals(4, $generator->rand(1,100));
   }

    public function testRandBounds()
    {
        $generator = new CyclicNumberGenerator(array(4, 4));

        $this->setExpectedException('OutOfRangeException');
        $generator->rand(1, 3);

        $this->setExpectedException('OutOfRangeException');
        $generator->rand(5, 10);
    }
}

