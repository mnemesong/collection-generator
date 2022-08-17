<?php
namespace Mnemesong\CollectionGeneratorTestUnit\tools;

use Mnemesong\CollectionGeneratorStubs\CollectionParserStub;
use Mnemesong\CollectionGeneratorStubs\SomeNewInterface;

class CollectionParserForInterfaceTest extends \PHPUnit\Framework\TestCase
{
    protected ?CollectionParserStub $collectionParser = null;

    public function init()
    {
        $this->collectionParser = new CollectionParserStub(SomeNewInterface::class);
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
        $this->collectionParser->replaceClass(SomeNewInterface::class);

        $this->assertFalse(stripos($this->collectionParser->getFileText(), 'class ObjectObjectCollection'));
        $this->assertNotFalse(stripos($this->collectionParser->getFileText(), 'class SomeNewInterfaceCollection'));

        $this->assertFalse(stripos($this->collectionParser->getFileText(), "use Mnemesong\\CollectionGenerator\\hidden\\ObjectObject;"));
        $this->assertNotFalse(stripos($this->collectionParser->getFileText(), "use Mnemesong\\CollectionGeneratorStubs\\SomeNewInterface;"));

        $this->assertFalse(stripos($this->collectionParser->getFileText(), "Collection of ObjectObjects"));
        $this->assertNotFalse(stripos($this->collectionParser->getFileText(), "Collection of SomeNewInterfaces"));

        $this->assertFalse(stripos($this->collectionParser->getFileText(), "ObjectObject;"));
    }

    public function testGetTargetFilePath()
    {
        $this->init();
        $ds = DIRECTORY_SEPARATOR;
        $this->assertEquals(
            $this->collectionParser->getTargetDirPath(SomeNewInterface::class),
            $this->getStubsFolder() . $ds . 'collections'
        );
    }

    public function testGenerateCollection()
    {
        $this->init();
        $ds = DIRECTORY_SEPARATOR;
        if(file_exists($this->getStubsFolder() . $ds . 'collections' . $ds . 'SomeNewInterfaceCollection.php')) {
            unlink($this->getStubsFolder() . $ds . 'collections' . $ds . 'SomeNewInterfaceCollection.php');
        }
        $this->collectionParser->generateCollection();
        $this->assertTrue(file_exists($this->getStubsFolder() . $ds . 'collections' . $ds . 'SomeNewInterfaceCollection.php'));
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