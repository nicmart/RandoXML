<?php
/**
 * Unit tests for RandomProvider class
 */
use nicmart\Random\Provider\RandomProvider;
use nicmart\Random\Number\NumberGenerator;
use nicmart\Random\Number\PhpNumberGenerator;

class RandomProviderTest extends PHPUnit_Framework_TestCase
{
    public function testAddString()
    {
        $string = new RandomProvider;

        $string
            ->addString('a', 2)
            ->addString('b')
        ;

        $strings = $string->getStrings();

        $this->assertEquals('a', $strings[0][0], 'Add string sets string correctly');
        $this->assertEquals(2, $strings[0][1], 'Add string sets weight correctly');
        $this->assertEquals('b', $strings[1][0], 'Add string sets string correctly');
        $this->assertEquals(1, $strings[1][1], 'Add string sets default weight to 1');
    }

    public function testGetNumberGeneratorReturnsPhpNumberGeneratorAsDefault()
    {
        $string = new RandomProvider;

        $generator = $string->getNumberGenerator();

        $this->assertInstanceOf('\nicmart\Random\Number\PhpNumberGenerator', $generator);
    }

    public function testSetAndGetNumberGenerator()
    {
        $string = new RandomProvider;
        $string->setNumberGenerator(new MockedNumberGenerator);

        $generator = $string->getNumberGenerator();

        $this->assertInstanceOf('MockedNumberGenerator', $generator);
    }

    public function testGetRandomString()
    {
        $string = new RandomProvider;

        $stringsAndWeights = array(
            array('ciao', 1),
            array('arrivederci', '1'),
            array('buonasera', '2'),
        );

        $plainStrings = array_map(function($item){ return $item[0]; }, $stringsAndWeights);

        $string->addStrings($stringsAndWeights);

        $this->assertContains($string->get(), $plainStrings);
    }

    public function testGetStrings()
    {
        $string = new RandomProvider;

        $stringsAndWeights = array(
            array('ciao', 1),
            array('arrivederci', '1'),
            array('buonasera', '2'),
        );

        $plainStrings = array_map(function($item){ return $item[0]; }, $stringsAndWeights);

        $string->addStrings($stringsAndWeights);

        $this->assertEquals($stringsAndWeights, $string->getStrings());
        $this->assertEquals($plainStrings, $string->getPlainStrings());
    }
}

class MockedNumberGenerator implements NumberGenerator
{
    /**
     * Returns an integer between $min and $max
     * @param int $min
     * @param int $max
     * @return mixed
     */
    public function rand($min, $max)
    {
        return 1;
    }

}
