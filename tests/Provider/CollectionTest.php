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

        $this->mock1->expects($this->any())
                ->method('get')
                ->will($this->returnValue('mock1'))
        ;

        $this->mock2 = $this->getMock('\nicmart\Random\Provider\Provider');

        $this->mock2->expects($this->any())
                ->method('get')
                ->will($this->returnValue('mock2'))
        ;

        $this->collection = new Collection;

        $this->collection
            ->register('a', $this->mock1)
            ->register('b', $this->mock2)
        ;
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testRegisterAndGetProvider()
    {
        $this->assertEquals($this->mock1, $this->collection->provider('a'));
        $this->assertEquals($this->mock2, $this->collection->provider('b'));

        //This must throw an exception
        $this->collection->provider('c');
    }

    public function testValue()
    {
        $collection = $this->collection;

        $this->assertEquals('mock1', $collection->value('a'));
        $this->assertEquals('mock2', $collection->value('b'));
    }

    public function testValueAndCachingProviderResults()
    {
        $collection = $this->collection;

        $mock1 = $this->getMock('\nicmart\Random\Provider\Provider');
        $mock1->expects($this->once())
                ->method('get')
                ->will($this->returnValue('aaa'))
        ;

        $mock2 = $this->getMock('\nicmart\Random\Provider\Provider');
        $mock2->expects($this->exactly(2))
                ->method('get')
                ->will($this->returnValue('bbb'))
        ;

        $collection->register('cached', $mock1, true);
        $collection->register('nocached', $mock2, false);

        //Call both values twice
        $collection->value('cached');
        $collection->value('cached');

        $collection->value('nocached');
        $collection->value('nocached');
    }
}
