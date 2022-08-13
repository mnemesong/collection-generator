<?php
declare(strict_types = 1);

namespace Mnemesong\CollectionGenerator\hidden;

class ObjectObject
{
    public string $value = '';

    public function __construct(string $value = '')
    {
        $this->value = $value;
    }

    public function addF(): void
    {
        $this->value .= 'F';
    }
}