<?php
/**
 * Unit tests for RandomString class
 */
use nicmart\Random\String\RandomString;

class RandomStringTest extends PHPUnit_Framework_TestCase
{
    public function testAddString()
    {
        $string = new RandomString;

        $string
            ->addString('a', 2)
            ->addString('b')
        ;

        $strings = $string->getStrings();

        $this->assertEquals('a', $strings[0][0], 'Add string sets string correctly');
        $this->assertEquals(2, $strings[0][1], 'Add string sets weight correctly');
        $this->assertEquals('b', $strings[1][0], 'Add string sets string correctly');
        $this->assertEquals(1, $strings[1][1], 'Add string sets default wight to 1');
    }

    public function testGetRandomString()
    {
        $string = new RandomString;

        $stringsAndWeights = array(
            array('ciao', 1),
            array('arrivederci', '1'),
            array('buonasera', '2'),
        );

        $plainStrings = array_map(function($item){ return $item[0]; }, $stringsAndWeights);

        $string->addStrings($stringsAndWeights);

        $this->assertContains($string->get(), $plainStrings);
    }
}
