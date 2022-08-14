<?php
namespace Mnemesong\CollectionGeneratorTest\tools;

use Mnemesong\CollectionGeneratorStubs\CollectionParserStub;
use Mnemesong\CollectionGeneratorStubs\SomeNewObject;

class CollectionParserForObjectTest extends \PHPUnit\Framework\TestCase
{
    protected ?CollectionParserStub $collectionParser = null;

    public function init()
    {
        $this->collectionParser = new CollectionParserStub(SomeNewObject::class);
    }

    public function testConstructor()
    {
        $this->init();
        $this->assertNotFalse(stripos($this->collectionParser->getFileText(), 'class ObjectObjectCollection'));
        $this->assertNotFalse(stripos($this->collectionParser->getFileText(), "namespace Mnemesong\CollectionGenerator\hidden\collection;"));
        $this->assertNotFalse(stripos($this->collectionParser->getFileText(), "public function __construct(array \$objects = [])"));
    }

    public function testReplaceNamespace()
    {
        $this->init();
        $this->collectionParser->replaceNamespace('Test\Namespace');
        $this->assertNotFalse(stripos($this->collectionParser->getFileText(), 'class ObjectObjectCollection'));
        $this->assertFalse(stripos($this->collectionParser->getFileText(), "namespace Mnemesong\CollectionGenerator\hidden\collection;"));
        $this->assertNotFalse(stripos($this->collectionParser->getFileText(), "namespace Test\Namespace;"));
    }

    public function testReplaceClass()
    {
        $this->init();
        $this->collectionParser->replaceClass(SomeNewObject::class);

        $this->assertFalse(stripos($this->collectionParser->getFileText(), 'class ObjectObjectCollection'));
        $this->assertNotFalse(stripos($this->collectionParser->getFileText(), 'class SomeNewObjectCollection'));

        $this->assertFalse(stripos($this->collectionParser->getFileText(), "use Mnemesong\\CollectionGenerator\\hidden\\ObjectObject;"));
        $this->assertNotFalse(stripos($this->collectionParser->getFileText(), "use Mnemesong\\CollectionGeneratorStubs\\SomeNewObject;"));

        $this->assertFalse(stripos($this->collectionParser->getFileText(), "Collection of ObjectObjects"));
        $this->assertNotFalse(stripos($this->collectionParser->getFileText(), "Collection of SomeNewObjects"));

        $this->assertFalse(stripos($this->collectionParser->getFileText(), "ObjectObject;"));
    }

    public function testGetTargetFilePath()
    {
        $this->init();
        $this->assertEquals(
            $this->collectionParser->getTargetDirPath(SomeNewObject::class),
            $this->getStubsFolder() . DIRECTORY_SEPARATOR . 'collections'
        );
    }

    public function testGenerateCollection()
    {
        $this->init();
        $ds = DIRECTORY_SEPARATOR;
        if(file_exists($this->getStubsFolder() . 'collections' . $ds . 'SomeNewObjectCollection.php')) {
            unlink($this->getStubsFolder() . $ds . 'collections' . $ds . 'SomeNewObjectCollection.php');
        }
        $this->collectionParser->generateCollection();
        $this->assertTrue(file_exists($this->getStubsFolder() . $ds . 'collections' . $ds . 'SomeNewObjectCollection.php'));
    }

    protected function getStubsFolder(): string
    {
        $ds = DIRECTORY_SEPARATOR;
        $targetDirParts = explode($ds, __DIR__);
        $targetDirParts = array_filter($targetDirParts, fn(int $index)
        => ($index < (count($targetDirParts) - 2)), ARRAY_FILTER_USE_KEY);
        return implode($ds, $targetDirParts) . $ds . 'test-stubs';
    }

}