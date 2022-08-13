<?php

namespace Mnemesong\CollectionGenerator;

use Mnemesong\CollectionGenerator\tools\CollectionParser;

class CollectionGenerator
{
    /**
     * @throws exceptions\EmptyClassException
     */
    public function generateForClass(string $class): void
    {
        $parser = new CollectionParser($class);
        $parser->generateCollection();
    }
}