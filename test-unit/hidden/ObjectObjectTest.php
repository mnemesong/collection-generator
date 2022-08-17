<?php
namespace Mnemesong\CollectionGeneratorTestUnit\hidden;

use Mnemesong\CollectionGenerator\hidden\ObjectObject;

class ObjectObjectTest extends \PHPUnit\Framework\TestCase
{
    public function testBase(): void
    {
        $object = new ObjectObject('21fd');
        $this->assertEquals('21fd', $object->value);
    }
}