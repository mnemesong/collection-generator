<?php
namespace Mnemesong\CollectionGeneratorTestUnit\tools;

use Mnemesong\CollectionGeneratorStubs\CollectionParserStub;
use Mnemesong\CollectionGeneratorStubs\SomeNewObject;
use Webmozart\Assert\Assert;

class CollectionParserForObjectTest extends \PHPUnit\Framework\TestCase
{
    protected function getCollectionParser(): CollectionParserStub
    {
        return new CollectionParserStub(SomeNewObject::class);
    }

    public function testConstructor(): void
    {
        $parser = self::getCollectionParser();
        $this->assertNotFalse(stripos($parser->getFileText(), 'class ObjectObjectCollection'));
        $this->assertNotFalse(stripos($parser->getFileText(), "namespace Mnemesong\CollectionGenerator\hidden\collection;"));
        $this->assertNotFalse(stripos($parser->getFileText(), "public function __construct(array \$objects = [])"));
    }

    public function testReplaceNamespace(): void
    {
        $parser = self::getCollectionParser();
        $parser->replaceNamespace('Test\Namespace');
        $this->assertNotFalse(stripos($parser->getFileText(), 'class ObjectObjectCollection'));
        $this->assertFalse(stripos($parser->getFileText(), "namespace Mnemesong\CollectionGenerator\hidden\collection;"));
        $this->assertNotFalse(stripos($parser->getFileText(), "namespace Test\Namespace;"));
    }

    public function testReplaceClass(): void
    {
        $parser = self::getCollectionParser();
        $parser->replaceClass(SomeNewObject::class);

        $this->assertFalse(stripos($parser->getFileText(), 'class ObjectObjectCollection'));
        $this->assertNotFalse(stripos($parser->getFileText(), 'class SomeNewObjectCollection'));

        $this->assertFalse(stripos($parser->getFileText(), "use Mnemesong\\CollectionGenerator\\hidden\\ObjectObject;"));
        $this->assertNotFalse(stripos($parser->getFileText(), "use Mnemesong\\CollectionGeneratorStubs\\SomeNewObject;"));

        $this->assertFalse(stripos($parser->getFileText(), "Collection of ObjectObjects"));
        $this->assertNotFalse(stripos($parser->getFileText(), "Collection of SomeNewObjects"));

        $this->assertFalse(stripos($parser->getFileText(), "ObjectObject;"));
    }

    public function testGetTargetFilePath(): void
    {
        $parser = self::getCollectionParser();
        $this->assertEquals(
            $parser->getTargetDirPath(SomeNewObject::class),
            $this->getStubsFolder() . DIRECTORY_SEPARATOR . 'collections'
        );
    }

    public function testGenerateCollection(): void
    {
        $parser = self::getCollectionParser();
        $ds = DIRECTORY_SEPARATOR;
        if(file_exists($this->getStubsFolder() . 'collections' . $ds . 'SomeNewObjectCollection.php')) {
            unlink($this->getStubsFolder() . $ds . 'collections' . $ds . 'SomeNewObjectCollection.php');
        }
        $parser->generateCollection();
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