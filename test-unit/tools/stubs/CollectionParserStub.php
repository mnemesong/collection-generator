<?php

namespace Mnemesong\CollectionGeneratorTest\tools\stubs;

use Mnemesong\CollectionGenerator\tools\CollectionParser;

class CollectionParserStub extends CollectionParser
{
    public function getFileText(): string
    {
        return $this->fileText;
    }

    public function replaceNamespace(string $newNamespace): void
    {
        parent::replaceNamespace($newNamespace);
    }

    public function replaceClass(string $newObjectClass): void
    {
        parent::replaceClass($newObjectClass);
    }

    public function getTargetDirPath(string $class): string
    {
        return parent::getTargetDirPath($class);
    }
}