<?php
use Mnemesong\CollectionGeneratorTest\tools\stubs\CollectionParserStub;
use Mnemesong\CollectionGeneratorTest\tools\stubs\SomeNewObject;

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
        $this->assertNotFalse(stripos($this->collectionParser->getFileText(), "use Mnemesong\\CollectionGeneratorTest\\tools\\stubs\\SomeNewObject;"));

        $this->assertFalse(stripos($this->collectionParser->getFileText(), "Collection of ObjectObjects"));
        $this->assertNotFalse(stripos($this->collectionParser->getFileText(), "Collection of SomeNewObjects"));

        $this->assertFalse(stripos($this->collectionParser->getFileText(), "ObjectObject;"));
    }

    public function testGetTargetFilePath()
    {
        $this->init();
        $this->assertEquals(
            $this->collectionParser->getTargetDirPath(SomeNewObject::class),
            __DIR__ . DIRECTORY_SEPARATOR . 'stubs' . DIRECTORY_SEPARATOR . 'collections'
        );
    }

    public function testGenerateCollection()
    {
        $this->init();
        $ds = DIRECTORY_SEPARATOR;
        if(file_exists(__DIR__ . $ds . 'stubs' . $ds . 'collections' . $ds . 'SomeNewObjectCollection.php')) {
            unlink(__DIR__ . $ds . 'stubs' . $ds . 'collections' . $ds . 'SomeNewObjectCollection.php');
        }
        $this->collectionParser->generateCollection();
        $this->assertTrue(file_exists(__DIR__ . $ds . 'stubs' . $ds . 'collections' . $ds . 'SomeNewObjectCollection.php'));
    }

}