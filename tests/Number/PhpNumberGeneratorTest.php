<?php
/**
 * Unit tests for PhpNumberGenerator class
 */
use nicmart\Random\Number\PhpNumberGenerator;

class PhpNumberGeneratorTest extends PHPUnit_Framework_TestCase
{
    public function testRandBounds()
    {
        $generator = new PhpNumberGenerator;

        $this->setExpectedException('OutOfRangeException');

        $generator->rand(-1, 10);

        $this->setExpectedException('OutOfRangeException');

        $generator->rand(1, getrandmax()+1);
    }

    public function testRandRespectsGivenBoundsAndReturnsIntegers()
    {
        $generator = new PhpNumberGenerator;

        $n = $generator->rand(1, 20);

        $this->assertInternalType('int', $n);
        $this->assertLessThanOrEqual(20, $n);
        $this->assertGreaterThanOrEqual(1, $n);
    }
}

