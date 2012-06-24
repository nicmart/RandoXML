<?php
/**
 * Unit tests for RandomProvider class
 */
use nicmart\Random\Provider\RandomProvider;
use nicmart\Random\Number\NumberGenerator;
use nicmart\Random\Number\PhpNumberGenerator;

class RandomProviderTest extends PHPUnit_Framework_TestCase
{
    public function testAddChoice()
    {
        $provider = new RandomProvider;

        // A class of the standard library
        $object = new SplStack();

        $provider
            ->addChoice($object, 2)
            ->addChoice('b')
        ;

        $strings = $provider->getChoices();

        $this->assertEquals($object, $strings[0][0], 'Add string sets string correctly');
        $this->assertEquals(2, $strings[0][1], 'Add string sets weight correctly');
        $this->assertEquals('b', $strings[1][0], 'Add string sets string correctly');
        $this->assertEquals(1, $strings[1][1], 'Add string sets default weight to 1');
    }

    public function testGetNumberGeneratorReturnsPhpNumberGeneratorAsDefault()
    {
        $provider = new RandomProvider;

        $generator = $provider->getNumberGenerator();

        $this->assertInstanceOf('\nicmart\Random\Number\PhpNumberGenerator', $generator);
    }

    public function testSetAndGetNumberGenerator()
    {
        $provider = new RandomProvider;
        $provider->setNumberGenerator(new MockedNumberGenerator);

        $generator = $provider->getNumberGenerator();

        $this->assertInstanceOf('MockedNumberGenerator', $generator);
    }

    public function testGet()
    {
        $provider = new RandomProvider;
        $provider->setNumberGenerator(new MockedNumberGenerator());

        $object = new SplStack();

        $weightedChoices = array(
            array($object, 1),
            array('arrivederci', '1'),
            array('buonasera', '2'),
        );

        $provider->addChoices($weightedChoices);

        $this->assertEquals('arrivederci', $provider->get());
    }

    public function testGetChoices()
    {
        $provider = new RandomProvider;
        $object = new SplStack();

        $weightedChoices = array(
            array($object, 1),
            array('arrivederci', '1'),
            array('buonasera', '2'),
        );

        $plainStrings = array_map(function($item){ return $item[0]; }, $weightedChoices);

        $provider->addChoices($weightedChoices);

        $this->assertEquals($weightedChoices, $provider->getChoices());
        $this->assertEquals($plainStrings, $provider->getPlainChoices());
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

    /**
     * Returns the max integer supported by the generator
     *
     * @return int
     */
    public function randMax()
    {
        return getrandmax();
    }


}
