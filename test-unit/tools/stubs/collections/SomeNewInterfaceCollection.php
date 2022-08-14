<?php
declare(strict_types=1);

namespace Mnemesong\CollectionGeneratorTest\tools\stubs\collections;

use Mnemesong\CollectionGeneratorTest\tools\stubs\SomeNewInterface;
use Webmozart\Assert\Assert;

/**
 * Collection of SomeNewInterfaces.
 *
 * Generated by: mnemesong\collection-generator v.0.4
 */
final class SomeNewInterfaceCollection implements \Countable, \JsonSerializable
{
    /* @var \Mnemesong\CollectionGeneratorTest\tools\stubs\SomeNewInterface[] $objects */
    /* @phpstan-ignore-next-line  */
    protected array $objects = [];

    /**
     * @param SomeNewInterface[] $objects
     */
    public function __construct(array $objects = [])
    {
        Assert::allIsInstanceOf($objects, SomeNewInterface::class);
        $this->objects = array_values($objects);
    }

    /**
     * @param \Mnemesong\CollectionGeneratorTest\tools\stubs\SomeNewInterface $object
     * @return self
     */
    public function withNewOneItem(SomeNewInterface $object): self
    {
        Assert::isInstanceOf($object, SomeNewInterface::class,
            "Added items should be instance of SomeNewInterface");
        $clone = clone $this;
        $clone->objects[] = $object;
        return $clone;
    }

    /**
     * @param \Mnemesong\CollectionGeneratorTest\tools\stubs\SomeNewInterface[] $objects
     * @return self
     */
    public function withManyNewItems(array $objects): self
    {
        Assert::allIsInstanceOf($objects, SomeNewInterface::class);
        $clone = clone $this;
        $clone->objects = array_merge($clone->objects, array_values($objects));
        return $clone;
    }

    /**
     * @return SomeNewInterface[]
     */
    public function getAll(): array
    {
        return $this->objects;
    }

    /**
     * @param \Mnemesong\CollectionGeneratorTest\tools\stubs\SomeNewInterface $object
     * @return int|null
     */
    protected function getIndex(SomeNewInterface $object): ?int
    {
        $filtered = array_filter($this->objects, function (SomeNewInterface $innerObject) use ($object) {
            return $innerObject == $object;
        });
        if(count($filtered) > 0) {
            return current(array_keys($filtered));
        }
        return null;
    }

    /**
     * @param \Mnemesong\CollectionGeneratorTest\tools\stubs\SomeNewInterface $object
     * @return int[]
     */
    protected function getAllIndexes(SomeNewInterface $object): array
    {
        $filtered = array_filter($this->objects, function (SomeNewInterface $innerObject) use ($object) {
            return $innerObject == $object;
        });
        return array_keys($filtered);
    }

    /**
     * @param \Mnemesong\CollectionGeneratorTest\tools\stubs\SomeNewInterface $object
     * @param int $limit
     * @return self
     */
    public function withoutObjectsLike(SomeNewInterface $object, int $limit = 0): self
    {
        $arr = $this->objects;
        $i = $limit;
        if($limit < 0) {
            $arr = array_reverse($arr);
            $i = -$limit;
        }
        $newArr = [];
        foreach ($arr as $item)
        {
            if($limit !== 0) {
                if($item != $object)  {
                    $newArr[] = $item;
                } else {
                    if($i > 0) {
                        $i--;
                    } else {
                        $newArr[] = $item;
                    }
                }
            } else {
                if($item != $object)  {
                    $newArr[] = $item;
                }
            }
        }
        if($limit < 0) {
            $newArr = array_reverse($newArr);
        }
        return new self($newArr);
    }

    /**
     * @param callable $callbackFunction
     * @return self
     */
    public function filteredBy(callable $callbackFunction): self
    {
        $clone = clone $this;
        $clone->objects = array_values(array_filter($clone->objects, $callbackFunction));
        return $clone;
    }

    /**
     * @param callable $callbackFunction
     * @return array
     */
    /* @phpstan-ignore-next-line  */
    public function map(callable $callbackFunction): array
    {
        return array_map($callbackFunction, $this->objects);
    }

    /**
     * @param callable $callbackFunction
     * @return self
     * @throws \ErrorException
     */
    public function reworkedBy(callable $callbackFunction): self
    {
        $newArray = array_map($callbackFunction, $this->objects);
        $checkFilter = array_filter($newArray, function ($item) {
            return !is_a($item, SomeNewInterface::class);
        });
        if(!empty($checkFilter)) {
            throw new \ErrorException('Wrong type result at Apply() method execution in collection ' . self::class);
        }
        $clone = clone $this;
        $clone->objects = $newArray;
        return $clone;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->objects);
    }

    /**
     * @return \Mnemesong\CollectionGeneratorTest\tools\stubs\SomeNewInterface[]
     */
    public function jsonSerialize(): array
    {
        return $this->objects;
    }

    /**
     * @return \Mnemesong\CollectionGeneratorTest\tools\stubs\SomeNewInterface
     */
    public function getFirstAsserted(): SomeNewInterface
    {
        if($this->count() === 0) {
            throw new \RuntimeException('Error: try to get first element from empty SomeNewInterfaces collection');
        }
        return $this->objects[array_key_first($this->objects)];
    }

    /**
     * @return \Mnemesong\CollectionGeneratorTest\tools\stubs\SomeNewInterface
     */
    public function getLastAsserted(): SomeNewInterface
    {
        if($this->count() === 0) {
            throw new \RuntimeException('Error: try to get last element from empty SomeNewInterfaces collection');
        }
        return $this->objects[array_key_last($this->objects)];
    }

    /**
     * @param callable $func
     * @return self
     */
    public function assertCount(callable $func): self
    {
        if($func($this->count()) !== true) {
            throw new \AssertionError('Count assert error');
        }
        return $this;
    }

    /**
     * @return \Mnemesong\CollectionGeneratorTest\tools\stubs\SomeNewInterface|null
     */
    public function getFirstOrNull(): ?SomeNewInterface
    {
        if($this->count() > 0) {
            return $this->getFirstAsserted();
        }
        return null;
    }

    /**
     * @return \Mnemesong\CollectionGeneratorTest\tools\stubs\SomeNewInterface|null
     */
    public function getLastOrNull(): ?SomeNewInterface
    {
        if($this->count() > 0) {
            return $this->getLastAsserted();
        }
        return null;
    }

    /**
     * @param callable $sortFunc
     * @return $this
     * @throws \ErrorException
     */
    public function sortedBy(callable $sortFunc): self
    {
        $clone = clone $this;
        if(uasort($clone->objects, $sortFunc) === false) {
            throw new \ErrorException('Error while resorting collection');
        }
        $clone->objects = array_values($clone->objects);
        return $clone;
    }

}