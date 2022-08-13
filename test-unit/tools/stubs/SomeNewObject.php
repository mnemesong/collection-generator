<?php
declare(strict_types = 1);

namespace Mnemesong\CollectionGeneratorTest\tools\stubs;

use Mnemesong\CollectionGenerator\hidden\ObjectObject;

class SomeNewObject implements SomeNewInterface
{
    public string $val = '';

    public function __construct(string $val = '')
    {
        $this->val = $val;
    }

    public function getVal(): string
    {
        return $this->val;
    }

    public function setVal(string $val): void
    {
        $this->val = $val;
    }

    public function addJ(): void
    {
        $this->val .= "J";
    }

    public function isEmpty(): bool
    {
        return empty($this->val);
    }
}