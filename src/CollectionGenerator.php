<?php

namespace Mnemesong\CollectionGenerator;

use Mnemesong\CollectionGenerator\tools\CollectionParser;

class CollectionGenerator
{
    /**
     * @param class-string $class
     * @throws \ReflectionException
     * @throws exceptions\EmptyClassException
     */
    public function generateForClass(string $class): void
    {
        $parser = new CollectionParser($class);
        $parser->generateCollection();
    }
}