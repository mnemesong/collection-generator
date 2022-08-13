<?php
namespace Mnemesong\CollectionGeneratorTest\hidden;

use Mnemesong\CollectionGenerator\hidden\collection\ObjectObjectCollection;
use Mnemesong\CollectionGenerator\hidden\ObjectObject;

class ObjectObjectCollectionIteratorTest extends \PHPUnit\Framework\TestCase
{
    protected array $arrayOfObjects;

    public function init()
    {
        $this->arrayOfObjects = [
            new ObjectObject('c234'),
            new ObjectObject('cg'),
            new ObjectObject('c234'),
            new ObjectObject('ax7w84'),
        ];
    }

    public function testCurrent()
    {
        $this->init();
        $collection = new ObjectObjectCollection($this->arrayOfObjects);
        $iterator = $collection->getIterator();
        $this->assertEquals($iterator->current(), new ObjectObject('c234'));
    }

    public function testNext()
    {
        $this->init();
        $collection = new ObjectObjectCollection($this->arrayOfObjects);
        $iterator = $collection->getIterator();
        $iterator->next();
        $this->assertEquals($iterator->current(), new ObjectObject('cg'));
        $iterator->next();
        $this->assertEquals($iterator->current(), new ObjectObject('c234'));
        $iterator->next();
        $this->assertEquals($iterator->current(), new ObjectObject('ax7w84'));
        $iterator->next();
        $this->assertNull($iterator->current());
    }

    public function testKey() {
        $this->init();
        $collection = new ObjectObjectCollection($this->arrayOfObjects);
        $iterator = $collection->getIterator();
        $this->assertEquals($iterator->key(), 0);
        $iterator->next();
        $iterator->next();
        $this->assertEquals($iterator->key(), 2);
    }

    public function testValid()
    {
        $this->init();
        $collection = new ObjectObjectCollection($this->arrayOfObjects);
        $iterator = $collection->getIterator();
        $iterator->next();
        $iterator->next();
        $iterator->next();
        $this->assertTrue($iterator->valid());
        $iterator->next();
        $this->assertFalse($iterator->valid());
    }

    public function testRewind()
    {
        $this->init();
        $collection = new ObjectObjectCollection($this->arrayOfObjects);
        $iterator = $collection->getIterator();
        $iterator->next();
        $iterator->next();
        $iterator->next();
        $iterator->rewind();
        $this->assertEquals($iterator->current(), new ObjectObject('c234'));
        $iterator->next();
        $iterator->next();
        $iterator->next();
        $iterator->next();
        $iterator->rewind();
        $this->assertEquals($iterator->current(), new ObjectObject('c234'));
    }

}