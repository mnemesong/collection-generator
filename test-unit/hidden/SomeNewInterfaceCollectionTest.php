<?php
declare(strict_types = 0);
namespace Mnemesong\CollectionGeneratorTestUnit\hidden;

use Mnemesong\CollectionGenerator\hidden\ObjectObject;
use Mnemesong\CollectionGeneratorStubs\SomeNewObject;
use Mnemesong\CollectionGeneratorStubs\collections\SomeNewInterfaceCollection;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class SomeNewInterfaceCollectionTest extends TestCase
{
    public static function getArrayObjects(): array
    {
        return [
            new SomeNewObject('c234'),
            new SomeNewObject('cg'),
            new SomeNewObject('c234'),
            new SomeNewObject('ax7w84'),
        ];
    }

    public function testConstruct()
    {
        $collection = new SomeNewInterfaceCollection(self::getArrayObjects());
        $this->assertEquals($collection->getAll(), self::getArrayObjects());
    }

    public function testAdd()
    {
        $collection = new SomeNewInterfaceCollection(self::getArrayObjects());
        $newCollection = $collection
            ->withNewOneItem(new SomeNewObject('as7d8'))
            ->withNewOneItem(new SomeNewObject('v1v51'));

        //Test objects head been added successfull
        $this->assertEquals([
            new SomeNewObject('c234'),
            new SomeNewObject('cg'),
            new SomeNewObject('c234'),
            new SomeNewObject('ax7w84'),
            new SomeNewObject('as7d8'),
            new SomeNewObject('v1v51')
        ], $newCollection->getAll());

        //Test original collection unmutable
        $this->assertEquals([
            new SomeNewObject('c234'),
            new SomeNewObject('cg'),
            new SomeNewObject('c234'),
            new SomeNewObject('ax7w84'),
        ], $collection->getAll());
    }

    public function testAddOneException()
    {
        $collection = new SomeNewInterfaceCollection(self::getArrayObjects());
        $this->expectException(\TypeError::class);
        $newCollection = $collection
            /* @phpstan-ignore-next-line */
            ->withNewOneItem(new ObjectObject('as7d8'));
    }

    public function addMany()
    {
        $collection = new SomeNewInterfaceCollection(self::getArrayObjects());
        $newCollection = $collection
            ->withManyNewItems([new SomeNewObject('as7d8')])
            ->withManyNewItems([new SomeNewObject('v1v51'), new SomeNewObject('9871hkl')]);

        //Test objects head been added successfull
        $this->assertEquals([
            new SomeNewObject('c234'),
            new SomeNewObject('cg'),
            new SomeNewObject('c234'),
            new SomeNewObject('ax7w84'),
            new SomeNewObject('as7d8'),
            new SomeNewObject('v1v51'),
            new SomeNewObject('9871hkl')
        ], $newCollection->getAll());

        //Test original collection unmutable
        $this->assertEquals([
            new SomeNewObject('c234'),
            new SomeNewObject('cg'),
            new SomeNewObject('c234'),
            new SomeNewObject('ax7w84'),
        ], $collection->getAll());
    }

    public function testAddManyException()
    {
        $collection = new SomeNewInterfaceCollection(self::getArrayObjects());
        $this->expectException(\InvalidArgumentException::class);
        $newCollection = $collection
            /* @phpstan-ignore-next-line */
            ->withManyNewItems([new ObjectObject('9871hkl'), new SomeNewObject('as7d8')]);
    }

    public function testWithoutOneObjectLike()
    {
        $collection = new SomeNewInterfaceCollection(self::getArrayObjects());
        $newCollection = $collection
            ->withoutObjectsLike(new SomeNewObject('c234'), 1);

        //Test removing
        $this->assertEquals([
            new SomeNewObject('cg'),
            new SomeNewObject('c234'),
            new SomeNewObject('ax7w84'),
        ], $newCollection->getAll());

        //Test original collection hadn't been muted
        $this->assertEquals([
            new SomeNewObject('c234'),
            new SomeNewObject('cg'),
            new SomeNewObject('c234'),
            new SomeNewObject('ax7w84'),
        ], $collection->getAll());

        $newCollection = $collection
            ->withoutObjectsLike(new SomeNewObject('c234'));

        //Test unlimited removing
        $this->assertEquals([
            new SomeNewObject('cg'),
            new SomeNewObject('ax7w84'),
        ], $newCollection->getAll());

        $newCollection = $collection
            ->withoutObjectsLike(new SomeNewObject('c234'), -1);

        //Test reversed limit removing
        $this->assertEquals([
            new SomeNewObject('c234'),
            new SomeNewObject('cg'),
            new SomeNewObject('ax7w84'),
        ], $newCollection->getAll());
    }

    public function testFiltering()
    {
        $collection = new SomeNewInterfaceCollection(self::getArrayObjects());
        $newCollection = $collection
            ->filteredBy(fn(SomeNewObject $object) => (strlen($object->val) > 2));

        //Test filtering
        $this->assertEquals([
            new SomeNewObject('c234'),
            new SomeNewObject('c234'),
            new SomeNewObject('ax7w84'),
        ], $newCollection->getAll());

        //Test original collection hadn't been muted
        $this->assertEquals([
            new SomeNewObject('c234'),
            new SomeNewObject('cg'),
            new SomeNewObject('c234'),
            new SomeNewObject('ax7w84'),
        ], $collection->getAll());
    }

    public function testMapping()
    {
        $collection = new SomeNewInterfaceCollection(self::getArrayObjects());
        $mapped = $collection
            ->map(fn(SomeNewObject $object) => ($object->val . '!'));

        //Test filtering
        $this->assertEquals([
            'c234!',
            'cg!',
            'c234!',
            'ax7w84!',
        ], $mapped);

        //Test original collection hadn't been muted
        $this->assertEquals([
            new SomeNewObject('c234'),
            new SomeNewObject('cg'),
            new SomeNewObject('c234'),
            new SomeNewObject('ax7w84'),
        ], $collection->getAll());
    }

    public function testReworkingBy()
    {
        $collection = new SomeNewInterfaceCollection(self::getArrayObjects());
        $newCollection = $collection
            ->reworkedBy(fn(SomeNewObject $object) => (new SomeNewObject($object->val . '!')));

        //Test reworking
        $this->assertEquals([
            new SomeNewObject('c234!'),
            new SomeNewObject('cg!'),
            new SomeNewObject('c234!'),
            new SomeNewObject('ax7w84!'),
        ], $newCollection->getAll());

        //Test original collection hadn't been muted
        $this->assertEquals([
            new SomeNewObject('c234'),
            new SomeNewObject('cg'),
            new SomeNewObject('c234'),
            new SomeNewObject('ax7w84'),
        ], $collection->getAll());
    }

    public function testCount()
    {
        $collection = new SomeNewInterfaceCollection(self::getArrayObjects());
        $this->assertEquals($collection->count(), 4);

        $newCollection = $collection->withNewOneItem(new SomeNewObject('dc1`2'));
        $this->assertEquals($newCollection->count(), 5);
    }

    public function testJsonSerialize()
    {
        $collection = new SomeNewInterfaceCollection(self::getArrayObjects());
        $this->assertEquals(self::getArrayObjects(), $collection->getAll());
    }

    public function testGetFirst()
    {
        $collection = new SomeNewInterfaceCollection(self::getArrayObjects());
        $this->assertEquals(new SomeNewObject('c234'), $collection->getFirstAsserted());
    }

    public function testGetFirstException()
    {
        $collection = new SomeNewInterfaceCollection([]);
        $this->expectException(RuntimeException::class);
        $collection->getFirstAsserted();
    }

    public function testGetFirstOrNull()
    {
        $collection = new SomeNewInterfaceCollection(self::getArrayObjects());
        $this->assertEquals(new SomeNewObject('c234'), $collection->getFirstOrNull());

        $collection = new SomeNewInterfaceCollection([]);
        $this->assertNull($collection->getFirstOrNull());
    }

    public function testGetLast()
    {
        $collection = new SomeNewInterfaceCollection(self::getArrayObjects());
        $this->assertEquals(new SomeNewObject('ax7w84'), $collection->getLastAsserted());
    }

    public function testGetLastException()
    {
        $collection = new SomeNewInterfaceCollection([]);
        $this->expectException(RuntimeException::class);
        $collection->getLastAsserted();
    }

    public function testGetLastOrNull()
    {
        $collection = new SomeNewInterfaceCollection(self::getArrayObjects());
        $this->assertEquals(new SomeNewObject('ax7w84'), $collection->getLastOrNull());

        $collection = new SomeNewInterfaceCollection([]);
        $this->assertNull($collection->getLastOrNull());
    }

    public function testAssertCount()
    {
        $collection = new SomeNewInterfaceCollection(self::getArrayObjects());
        $first = $collection
            ->assertCount(fn(int $count) => ($count === 4))
            ->getFirstOrNull();
        $this->assertEquals(new SomeNewObject('c234'), $first);
    }

    public function testAssertCountException1()
    {
        $collection = new SomeNewInterfaceCollection(self::getArrayObjects());
        $this->expectException(\AssertionError::class);
        $collection->assertCount(fn(int $count) => ($count === 5));
    }

    public function testAssertCountException2()
    {
        $collection = new SomeNewInterfaceCollection(self::getArrayObjects());
        $this->expectException(\TypeError::class);
        $collection->assertCount(fn(array $count) => ($count));
    }

    public function testSort()
    {
        $collection = new SomeNewInterfaceCollection(self::getArrayObjects());
        $newCollection = $collection
            ->sortedBy(fn(SomeNewObject $obj1, SomeNewObject $obj2) => (strcasecmp($obj1->val, $obj2->val)));

        //Test sorting
        $this->assertEquals([
            new SomeNewObject('ax7w84'),
            new SomeNewObject('c234'),
            new SomeNewObject('c234'),
            new SomeNewObject('cg'),
        ], $newCollection->getAll());

        //Test original collection hadn't been muted
        $this->assertEquals([
            new SomeNewObject('c234'),
            new SomeNewObject('cg'),
            new SomeNewObject('c234'),
            new SomeNewObject('ax7w84'),
        ], $collection->getAll());
    }

}