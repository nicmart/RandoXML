<?php
/**
 * Unit tests for RandomProvider class
 */
use nicmart\Random\Provider\Provider;
use nicmart\Random\Provider\Collection;

class CollectionTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->mock1 = $this->getMock('\nicmart\Random\Provider\Provider');
        $this->mock2 = $this->getMock('\nicmart\Random\Provider\Provider');
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testRegisterAndGetProvider()
    {
        $collection = new Collection;

        $collection
            ->register('a', $this->mock1)
            ->register('b', $this->mock2)
        ;

        $this->assertEquals($this->mock1, $collection->provider('a'));
        $this->assertEquals($this->mock2, $collection->provider('b'));

        //This must throw an exception
        $collection->provider('c');
    }
}
