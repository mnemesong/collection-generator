<?php
declare(strict_types = 0);
namespace Mnemesong\CollectionGeneratorTest\hidden;

use ErrorException;
use Iterator;
use Mnemesong\CollectionGenerator\hidden\ObjectObject;
use Mnemesong\CollectionGenerator\hidden\collection\ObjectObjectCollection;
use RuntimeException;

class ObjectObjectCollectionTest extends \PHPUnit\Framework\TestCase
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

    public function testConstruct()
    {
        $this->init();
        $collection = new ObjectObjectCollection($this->arrayOfObjects);
        $this->assertEquals($collection->getAll(), $this->arrayOfObjects);
    }

    public function testAdd()
    {
        $this->init();
        $collection = new ObjectObjectCollection($this->arrayOfObjects);
        $collection->add(new ObjectObject('as7d8'));
        $this->assertEquals($collection->getAll(), [
            new ObjectObject('c234'),
            new ObjectObject('cg'),
            new ObjectObject('c234'),
            new ObjectObject('ax7w84'),
            new ObjectObject('as7d8'),
        ]);
    }

    public function testGetIndex()
    {
        $this->init();
        $collection = new class($this->arrayOfObjects) extends ObjectObjectCollection {
            public function getIndex(ObjectObject $object): ?int
            {
                return parent::getIndex($object);
            }
        };
        $this->assertEquals($collection->getIndex(new ObjectObject('c234')), 0);
        $this->assertEquals($collection->getIndex(new ObjectObject('ax7w84')), 3);
        $this->assertNull($collection->getIndex(new ObjectObject('asf89as')));
    }

    public function testRemoveObject()
    {
        $this->init();
        $collection = new ObjectObjectCollection($this->arrayOfObjects);
        $collection->removeObject(new ObjectObject('c234'));
        $this->assertEquals($collection->getAll(), [
            new ObjectObject('cg'),
            new ObjectObject('c234'),
            new ObjectObject('ax7w84'),
        ]);
    }

    public function testRemoveAll()
    {
        $this->init();
        $collection = new ObjectObjectCollection($this->arrayOfObjects);

        $this->assertEquals($collection->removeAll(new ObjectObject('c234')), 2);
        $this->assertEquals($collection->getAll(), [
            new ObjectObject('cg'),
            new ObjectObject('ax7w84'),
        ]);

        $this->assertEquals($collection->removeAll(new ObjectObject('ax7w84')), 1);
        $this->assertEquals($collection->getAll(), [
            new ObjectObject('cg'),
        ]);

        $this->assertEquals($collection->removeAll(new ObjectObject('dsf78')), 0);
        $this->assertEquals($collection->getAll(), [
            new ObjectObject('cg'),
        ]);
    }

    public function testGetAllIndexes()
    {
        $this->init();
        $collection = new class($this->arrayOfObjects) extends ObjectObjectCollection {
            public function getAllIndexes(ObjectObject $object): array
            {
                return parent::getAllIndexes($object);
            }
        };
        $this->assertEquals($collection->getAllIndexes(new ObjectObject('c234')), [0, 2]);
        $this->assertEquals($collection->getAllIndexes(new ObjectObject('ax7w84')), [3]);
        $this->assertEquals($collection->getAllIndexes(new ObjectObject('asf89as')), []);
    }

    public function testFilter()
    {
        $this->init();
        $collection = new ObjectObjectCollection($this->arrayOfObjects);
        $newCollection = $collection->filter(function (ObjectObject $item) {
            return stripos($item->value, '4') !== false;
        });
        $this->assertEquals($newCollection->getAll(), [
            new ObjectObject('c234'),
            new ObjectObject('c234'),
            new ObjectObject('ax7w84'),
        ]);
        $newCollection = $collection->filter(function (ObjectObject $item) {
            return stripos($item->value, '23') !== false;
        });
        $this->assertEquals($newCollection->getAll(), [
            new ObjectObject('c234'),
            new ObjectObject('c234'),
        ]);
    }

    public function testMap()
    {
        $this->init();
        $collection = new ObjectObjectCollection($this->arrayOfObjects);
        $arrayMap = $collection->map(function (ObjectObject $object) {
            return $object->value;
        });
        $this->assertEquals($arrayMap, [
            'c234',
            'cg',
            'c234',
            'ax7w84',
        ]);
    }

    public function testApply()
    {
        $this->init();
        $collection = new ObjectObjectCollection($this->arrayOfObjects);
        $collection->apply(function (ObjectObject $object) {
            $object->addF();
            return $object;
        });

        $this->assertEquals($collection->getAll(), [
            new ObjectObject('c234F'),
            new ObjectObject('cgF'),
            new ObjectObject('c234F'),
            new ObjectObject('ax7w84F'),
        ]);

        $this->expectException(ErrorException::class);
        $collection->apply(function (ObjectObject $object) {
            return 'F';
        });
    }

    public function testSearchIndexesOf()
    {
        $this->init();
        $collection = new ObjectObjectCollection($this->arrayOfObjects);
        $indexes = $collection->searchIndexesOf(function (ObjectObject $object) {
            return stripos($object->value, '23') != false;
        });
        $this->assertEquals($indexes, [0, 2]);
    }

    public function testCount()
    {
        $this->init();
        $collection = new ObjectObjectCollection($this->arrayOfObjects);
        $this->assertEquals(4, $collection->count());
    }

    public function testGetByIndex()
    {
        $this->init();
        $collection = new ObjectObjectCollection($this->arrayOfObjects);
        $this->assertEquals($collection->getByIndex(1), new ObjectObject('cg'));
        $this->assertEquals($collection->getByIndex(2), new ObjectObject('c234'));
    }

    public function testGetNextIndex()
    {
        $this->init();
        $collection = new ObjectObjectCollection($this->arrayOfObjects);
        $this->assertEquals($collection->getNextIndex(1), 2);
        $this->assertNull($collection->getNextIndex(3));
    }

    public function testGetFirstIndex()
    {
        $this->init();
        $collection = new ObjectObjectCollection($this->arrayOfObjects);
        $this->assertEquals($collection->getFirstIndex(), 0);
    }

    public function testGetIterator()
    {
        $this->init();
        $collection = new ObjectObjectCollection($this->arrayOfObjects);
        $this->assertTrue(is_subclass_of($collection->getIterator(), Iterator::class));
        /* Iterator tests placed into ObjectObjectCollectionIteratorTest class */
    }

    public function testSerialize()
    {
        $this->init();
        $collection = new ObjectObjectCollection($this->arrayOfObjects);
        $json = json_encode($collection, JSON_UNESCAPED_UNICODE);
        $this->assertEquals('[{"value":"c234"},{"value":"cg"},{"value":"c234"},{"value":"ax7w84"}]', $json);
    }

    public function testGetFirst()
    {
        $this->init();
        $collection = new ObjectObjectCollection($this->arrayOfObjects);
        $firstItem = $collection->getFirst();
        $this->assertEquals($firstItem, new ObjectObject('c234'));

        $collection = new ObjectObjectCollection([]);
        $this->expectException(RuntimeException::class);
        $firstItem = $collection->getFirst();
    }

    public function testGetLast()
    {
        $this->init();
        $collection = new ObjectObjectCollection($this->arrayOfObjects);
        $lastItem = $collection->getLast();
        $this->assertEquals($lastItem, new ObjectObject('ax7w84'));

        $collection = new ObjectObjectCollection([]);
        $this->expectException(RuntimeException::class);
        $lastItem = $collection->getLast();
    }

    public function testAssertCountEquals()
    {
        $this->init();
        $collection = new ObjectObjectCollection($this->arrayOfObjects);
        $this->assertEquals($collection->assertCount(fn(int $count) => ($count === 4)), $collection);
        $this->expectExceptionMessage('Count assert error');
        $collection->assertCount(fn(int $count) => ($count === 2));
    }

    public function testAssertCountNotEquals()
    {
        $this->init();
        $collection = new ObjectObjectCollection($this->arrayOfObjects);
        $this->assertEquals($collection->assertCount(fn(int $count) => ($count !== 3)), $collection);
        $this->expectExceptionMessage('Count assert error');
        $collection->assertCount(fn(int $count) => ($count !== 4));
    }

    public function testAssertCountGreaterThen()
    {
        $this->init();
        $collection = new ObjectObjectCollection($this->arrayOfObjects);
        $this->assertEquals($collection->assertCount(fn(int $count) => ($count > 2)), $collection);
        $this->expectExceptionMessage('Count assert error');
        $collection->assertCount(fn(int $count) => ($count > 5));
    }

    public function testGetFirstOrNull()
    {
        $this->init();
        $collection = new ObjectObjectCollection($this->arrayOfObjects);
        $firstItem = $collection->getFirstOrNull();
        $this->assertEquals($firstItem, new ObjectObject('c234'));

        $collection = new ObjectObjectCollection([]);
        $this->assertNull($collection->getFirstOrNull());
    }

    public function testGetLastOrNull()
    {
        $this->init();
        $collection = new ObjectObjectCollection($this->arrayOfObjects);
        $lastItem = $collection->getLastOrNull();
        $this->assertEquals($lastItem, new ObjectObject('ax7w84'));

        $collection = new ObjectObjectCollection([]);
        $this->assertNull($collection->getLastOrNull());
    }

    public function testSort()
    {
        $this->init();
        $collection = new ObjectObjectCollection($this->arrayOfObjects);
        $collection->sort(fn(ObjectObject $item1, ObjectObject $item2) => (strcasecmp($item1->value, $item2->value)));
        $this->assertEquals($collection->getAll(), [
            new ObjectObject('ax7w84'),
            new ObjectObject('c234'),
            new ObjectObject('c234'),
            new ObjectObject('cg'),
        ]);
    }

    public function testReplaceItemByIndex()
    {
        $this->init();
        $collection = new ObjectObjectCollection($this->arrayOfObjects);
        $collection->replaceItemByIndex(1, new ObjectObject('aaaa'));
        $this->assertEquals($collection->getAll(), [
            new ObjectObject('c234'),
            new ObjectObject('aaaa'),
            new ObjectObject('c234'),
            new ObjectObject('ax7w84'),
        ]);
    }
}