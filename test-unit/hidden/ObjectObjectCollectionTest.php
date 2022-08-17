<?php
declare(strict_types = 0);
namespace Mnemesong\CollectionGeneratorTestUnit\hidden;

use Mnemesong\CollectionGenerator\hidden\collection\ObjectObjectCollection;
use Mnemesong\CollectionGenerator\hidden\ObjectObject;
use Mnemesong\CollectionGeneratorStubs\SomeNewObject;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class ObjectObjectCollectionTest extends TestCase
{
    public static function getArrayObjects(): array
    {
        return [
            new ObjectObject('c234'),
            new ObjectObject('cg'),
            new ObjectObject('c234'),
            new ObjectObject('ax7w84'),
        ];
    }

    public function testConstruct()
    {
        $collection = new ObjectObjectCollection(self::getArrayObjects());
        $this->assertEquals($collection->getAll(), self::getArrayObjects());
    }

    public function testAdd()
    {
        $collection = new ObjectObjectCollection(self::getArrayObjects());
        $newCollection = $collection
            ->withNewOneItem(new ObjectObject('as7d8'))
            ->withNewOneItem(new ObjectObject('v1v51'));

        //Test objects head been added successfull
        $this->assertEquals([
            new ObjectObject('c234'),
            new ObjectObject('cg'),
            new ObjectObject('c234'),
            new ObjectObject('ax7w84'),
            new ObjectObject('as7d8'),
            new ObjectObject('v1v51')
        ], $newCollection->getAll());

        //Test original collection unmutable
        $this->assertEquals([
            new ObjectObject('c234'),
            new ObjectObject('cg'),
            new ObjectObject('c234'),
            new ObjectObject('ax7w84'),
        ], $collection->getAll());
    }

    public function testAddOneException()
    {
        $collection = new ObjectObjectCollection(self::getArrayObjects());
        $this->expectException(\TypeError::class);
        $newCollection = $collection
            /* @phpstan-ignore-next-line */
            ->withNewOneItem(new SomeNewObject('as7d8'));
    }

    public function addMany()
    {
        $collection = new ObjectObjectCollection(self::getArrayObjects());
        $newCollection = $collection
            ->withManyNewItems([new ObjectObject('as7d8')])
            ->withManyNewItems([new ObjectObject('v1v51'), new ObjectObject('9871hkl')]);

        //Test objects head been added successfull
        $this->assertEquals([
            new ObjectObject('c234'),
            new ObjectObject('cg'),
            new ObjectObject('c234'),
            new ObjectObject('ax7w84'),
            new ObjectObject('as7d8'),
            new ObjectObject('v1v51'),
            new ObjectObject('9871hkl')
        ], $newCollection->getAll());

        //Test original collection unmutable
        $this->assertEquals([
            new ObjectObject('c234'),
            new ObjectObject('cg'),
            new ObjectObject('c234'),
            new ObjectObject('ax7w84'),
        ], $collection->getAll());
    }

    public function testAddManyException()
    {
        $collection = new ObjectObjectCollection(self::getArrayObjects());
        $this->expectException(\InvalidArgumentException::class);
        $newCollection = $collection
            /* @phpstan-ignore-next-line */
            ->withManyNewItems([new ObjectObject('9871hkl'), new SomeNewObject('as7d8')]);
    }

    public function testWithoutOneObjectLike()
    {
        $collection = new ObjectObjectCollection(self::getArrayObjects());
        $newCollection = $collection
            ->withoutObjectsLike(new ObjectObject('c234'), 1);

        //Test removing
        $this->assertEquals([
            new ObjectObject('cg'),
            new ObjectObject('c234'),
            new ObjectObject('ax7w84'),
        ], $newCollection->getAll());

        //Test original collection hadn't been muted
        $this->assertEquals([
            new ObjectObject('c234'),
            new ObjectObject('cg'),
            new ObjectObject('c234'),
            new ObjectObject('ax7w84'),
        ], $collection->getAll());

        $newCollection = $collection
            ->withoutObjectsLike(new ObjectObject('c234'));

        //Test unlimited removing
        $this->assertEquals([
            new ObjectObject('cg'),
            new ObjectObject('ax7w84'),
        ], $newCollection->getAll());

        $newCollection = $collection
            ->withoutObjectsLike(new ObjectObject('c234'), -1);

        //Test reversed limit removing
        $this->assertEquals([
            new ObjectObject('c234'),
            new ObjectObject('cg'),
            new ObjectObject('ax7w84'),
        ], $newCollection->getAll());
    }

    public function testFiltering()
    {
        $collection = new ObjectObjectCollection(self::getArrayObjects());
        $newCollection = $collection
            ->filteredBy(fn(ObjectObject $object) => (strlen($object->value) > 2));

        //Test filtering
        $this->assertEquals([
            new ObjectObject('c234'),
            new ObjectObject('c234'),
            new ObjectObject('ax7w84'),
        ], $newCollection->getAll());

        //Test original collection hadn't been muted
        $this->assertEquals([
            new ObjectObject('c234'),
            new ObjectObject('cg'),
            new ObjectObject('c234'),
            new ObjectObject('ax7w84'),
        ], $collection->getAll());
    }

    public function testMapping()
    {
        $collection = new ObjectObjectCollection(self::getArrayObjects());
        $mapped = $collection
            ->map(fn(ObjectObject $object) => ($object->value . '!'));

        //Test filtering
        $this->assertEquals([
            'c234!',
            'cg!',
            'c234!',
            'ax7w84!',
        ], $mapped);

        //Test original collection hadn't been muted
        $this->assertEquals([
            new ObjectObject('c234'),
            new ObjectObject('cg'),
            new ObjectObject('c234'),
            new ObjectObject('ax7w84'),
        ], $collection->getAll());
    }

    public function testReworkingBy()
    {
        $collection = new ObjectObjectCollection(self::getArrayObjects());
        $newCollection = $collection
            ->reworkedBy(fn(ObjectObject $object) => (new ObjectObject($object->value . '!')));

        //Test reworking
        $this->assertEquals([
            new ObjectObject('c234!'),
            new ObjectObject('cg!'),
            new ObjectObject('c234!'),
            new ObjectObject('ax7w84!'),
        ], $newCollection->getAll());

        //Test original collection hadn't been muted
        $this->assertEquals([
            new ObjectObject('c234'),
            new ObjectObject('cg'),
            new ObjectObject('c234'),
            new ObjectObject('ax7w84'),
        ], $collection->getAll());
    }

    public function testCount()
    {
        $collection = new ObjectObjectCollection(self::getArrayObjects());
        $this->assertEquals($collection->count(), 4);

        $newCollection = $collection->withNewOneItem(new ObjectObject('dc1`2'));
        $this->assertEquals($newCollection->count(), 5);
    }

    public function testJsonSerialize()
    {
        $collection = new ObjectObjectCollection(self::getArrayObjects());
        $this->assertEquals(self::getArrayObjects(), $collection->getAll());
    }

    public function testGetFirst()
    {
        $collection = new ObjectObjectCollection(self::getArrayObjects());
        $this->assertEquals(new ObjectObject('c234'), $collection->getFirstAsserted());
    }

    public function testGetFirstException()
    {
        $collection = new ObjectObjectCollection([]);
        $this->expectException(RuntimeException::class);
        $collection->getFirstAsserted();
    }

    public function testGetFirstOrNull()
    {
        $collection = new ObjectObjectCollection(self::getArrayObjects());
        $this->assertEquals(new ObjectObject('c234'), $collection->getFirstOrNull());

        $collection = new ObjectObjectCollection([]);
        $this->assertNull($collection->getFirstOrNull());
    }

    public function testGetLast()
    {
        $collection = new ObjectObjectCollection(self::getArrayObjects());
        $this->assertEquals(new ObjectObject('ax7w84'), $collection->getLastAsserted());
    }

    public function testGetLastException()
    {
        $collection = new ObjectObjectCollection([]);
        $this->expectException(RuntimeException::class);
        $collection->getLastAsserted();
    }

    public function testGetLastOrNull()
    {
        $collection = new ObjectObjectCollection(self::getArrayObjects());
        $this->assertEquals(new ObjectObject('ax7w84'), $collection->getLastOrNull());

        $collection = new ObjectObjectCollection([]);
        $this->assertNull($collection->getLastOrNull());
    }

    public function testAssertCount()
    {
        $collection = new ObjectObjectCollection(self::getArrayObjects());
        $first = $collection
            ->assertCount(fn(int $count) => ($count === 4))
            ->getFirstOrNull();
        $this->assertEquals(new ObjectObject('c234'), $first);
    }

    public function testAssertCountException1()
    {
        $collection = new ObjectObjectCollection(self::getArrayObjects());
        $this->expectException(\AssertionError::class);
        $collection->assertCount(fn(int $count) => ($count === 5));
    }

    public function testAssertCountException2()
    {
        $collection = new ObjectObjectCollection(self::getArrayObjects());
        $this->expectException(\TypeError::class);
        $collection->assertCount(fn(array $count) => ($count));
    }

    public function testSort()
    {
        $collection = new ObjectObjectCollection(self::getArrayObjects());
        $newCollection = $collection
            ->sortedBy(fn(ObjectObject $obj1, ObjectObject $obj2) => (strcasecmp($obj1->value, $obj2->value)));

        //Test sorting
        $this->assertEquals([
            new ObjectObject('ax7w84'),
            new ObjectObject('c234'),
            new ObjectObject('c234'),
            new ObjectObject('cg'),
        ], $newCollection->getAll());

        //Test original collection hadn't been muted
        $this->assertEquals([
            new ObjectObject('c234'),
            new ObjectObject('cg'),
            new ObjectObject('c234'),
            new ObjectObject('ax7w84'),
        ], $collection->getAll());
    }

}