<?php
namespace Mnemesong\CollectionGeneratorTest\hidden;

use Iterator;
use Mnemesong\CollectionGeneratorTest\tools\stubs\SomeNewObject;
use RuntimeException;
use TypeError;

class SomeNewInterfaceCollectionTest extends \PHPUnit\Framework\TestCase
{
    protected array $someNewObjects = [];

    public function init()
    {
        $this->someNewObjects = [
            new SomeNewObject('dasd98'),
            new SomeNewObject('as7a8fg'),
            new SomeNewObject(),
            new SomeNewObject('asf891'),
        ];
    }

    public function testSomeNewObjectCollectionConstructor()
    {
        $this->init();
        $collection = new \Mnemesong\CollectionGeneratorTest\tools\stubs\collections\SomeNewInterfaceCollection($this->someNewObjects);
        $this->assertEquals($collection->getAll(), $this->someNewObjects);

        $this->expectException(TypeError::class);
        /* @phpstan-ignore-next-line  */
        $collection = new \Mnemesong\CollectionGeneratorTest\tools\stubs\collections\SomeNewInterfaceCollection([1, 30]);
    }

    public function testAdd()
    {
        $this->init();
        $collection = new \Mnemesong\CollectionGeneratorTest\tools\stubs\collections\SomeNewInterfaceCollection($this->someNewObjects);
        $collection->add(new SomeNewObject('as7d8'));
        $this->assertEquals($collection->getAll(), [
            new SomeNewObject('dasd98'),
            new SomeNewObject('as7a8fg'),
            new SomeNewObject(),
            new SomeNewObject('asf891'),
            new SomeNewObject('as7d8'),
        ]);
    }

    public function testCount()
    {
        $this->init();
        $collection = new \Mnemesong\CollectionGeneratorTest\tools\stubs\collections\SomeNewInterfaceCollection($this->someNewObjects);
        $this->assertEquals(4, $collection->count());
    }

    public function testGetByIndex()
    {
        $this->init();
        $collection = new \Mnemesong\CollectionGeneratorTest\tools\stubs\collections\SomeNewInterfaceCollection($this->someNewObjects);
        $this->assertEquals($collection->getByIndex(1), new SomeNewObject('as7a8fg'));
        $this->assertEquals($collection->getByIndex(2), new SomeNewObject());
    }

    public function testGetNextIndex()
    {
        $this->init();
        $collection = new \Mnemesong\CollectionGeneratorTest\tools\stubs\collections\SomeNewInterfaceCollection($this->someNewObjects);
        $this->assertEquals($collection->getNextIndex(1), 2);
        $this->assertNull($collection->getNextIndex(3));
    }

    public function testGetFirstIndex()
    {
        $this->init();
        $collection = new \Mnemesong\CollectionGeneratorTest\tools\stubs\collections\SomeNewInterfaceCollection($this->someNewObjects);
        $this->assertEquals($collection->getFirstIndex(), 0);
    }

    public function testSerialize()
    {
        $this->init();
        $collection =
            new \Mnemesong\CollectionGeneratorTest\tools\stubs\collections\SomeNewInterfaceCollection($this->someNewObjects);
        $json = json_encode($collection, JSON_UNESCAPED_UNICODE);
        $this->assertEquals('[{"val":"dasd98"},{"val":"as7a8fg"},{"val":""},{"val":"asf891"}]', $json);
    }

    public function testGetFirst()
    {
        $this->init();
        $collection =
            new \Mnemesong\CollectionGeneratorTest\tools\stubs\collections\SomeNewInterfaceCollection($this->someNewObjects);
        $this->assertEquals($collection->getFirst(),  new SomeNewObject('dasd98'));

        $collection =
            new \Mnemesong\CollectionGeneratorTest\tools\stubs\collections\SomeNewInterfaceCollection([]);
        $this->expectException(RuntimeException::class);
        $lastItem = $collection->getFirst();
    }

    public function testGetLast()
    {
        $this->init();
        $collection =
            new \Mnemesong\CollectionGeneratorTest\tools\stubs\collections\SomeNewInterfaceCollection($this->someNewObjects);
        $this->assertEquals($collection->getLast(),  new SomeNewObject('asf891'));

        $collection =
            new \Mnemesong\CollectionGeneratorTest\tools\stubs\collections\SomeNewInterfaceCollection([]);
        $this->expectException(RuntimeException::class);
        $lastItem = $collection->getLast();
    }

    public function testAssertCountEquals()
    {
        $this->init();
        $collection =
            new \Mnemesong\CollectionGeneratorTest\tools\stubs\collections\SomeNewInterfaceCollection($this->someNewObjects);
        $this->assertEquals($collection->assertCount(fn(int $count) => ($count === 4)), $collection);
        $this->expectExceptionMessage('Count assert error');
        $collection->assertCount(fn(int $count) => ($count === 2));
    }

    public function testAssertCountNotEquals()
    {
        $this->init();
        $collection =
            new \Mnemesong\CollectionGeneratorTest\tools\stubs\collections\SomeNewInterfaceCollection($this->someNewObjects);
        $this->assertEquals($collection->assertCount(fn(int $count) => ($count !== 2)), $collection);
        $this->expectExceptionMessage('Count assert error');
        $collection->assertCount(fn(int $count) => ($count !== 4));
    }

    public function testAssertCountGreaterThen()
    {
        $this->init();
        $collection =
            new \Mnemesong\CollectionGeneratorTest\tools\stubs\collections\SomeNewInterfaceCollection($this->someNewObjects);
        $this->assertEquals($collection->assertCount(fn(int $count) => ($count > 3)), $collection);
        $this->expectExceptionMessage('Count assert error');
        $collection->assertCount(fn(int $count) => ($count > 4));
    }

    public function testGetFirstOrNull()
    {
        $this->init();
        $collection =
            new \Mnemesong\CollectionGeneratorTest\tools\stubs\collections\SomeNewInterfaceCollection($this->someNewObjects);
        $this->assertEquals($collection->getFirstOrNull(),  new SomeNewObject('dasd98'));

        $collection =
            new \Mnemesong\CollectionGeneratorTest\tools\stubs\collections\SomeNewInterfaceCollection([]);
        $lastItem = $collection->getFirstOrNull();
        $this->assertNull($lastItem);
    }

    public function testGetLastOrNull()
    {
        $this->init();
        $collection =
            new \Mnemesong\CollectionGeneratorTest\tools\stubs\collections\SomeNewInterfaceCollection($this->someNewObjects);
        $this->assertEquals($collection->getLastOrNull(),  new SomeNewObject('asf891'));

        $collection =
            new \Mnemesong\CollectionGeneratorTest\tools\stubs\collections\SomeNewInterfaceCollection([]);
        $lastItem = $collection->getLastOrNull();
        $this->assertNull($lastItem);
    }

    public function testSort()
    {
        $this->init();
        $collection = new \Mnemesong\CollectionGeneratorTest\tools\stubs\collections\SomeNewInterfaceCollection($this->someNewObjects);
        $collection->sort(fn(
            \Mnemesong\CollectionGeneratorTest\tools\stubs\SomeNewInterface $item1,
            \Mnemesong\CollectionGeneratorTest\tools\stubs\SomeNewInterface $item2
        ) => (strcasecmp($item1->getVal(), $item2->getVal())));
        $this->assertEquals($collection->getAll(), [
            new SomeNewObject(),
            new SomeNewObject('as7a8fg'),
            new SomeNewObject('asf891'),
            new SomeNewObject('dasd98'),
        ]);
    }

    public function testReplaceByIndex()
    {
        $this->init();
        $collection = new \Mnemesong\CollectionGeneratorTest\tools\stubs\collections\SomeNewInterfaceCollection(
            $this->someNewObjects);
        $collection->replaceItemByIndex(2, new SomeNewObject('aaaa'));
        $this->assertEquals($collection->getAll(), [
            new SomeNewObject('dasd98'),
            new SomeNewObject('as7a8fg'),
            new SomeNewObject('aaaa'),
            new SomeNewObject('asf891'),
        ]);
    }
}