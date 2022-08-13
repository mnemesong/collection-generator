<?php

namespace Mnemesong\CollectionGenerator\exceptions;

class ClassNotExistException extends \RuntimeException
{
    /* @phpstan-ignore-next-line  */
    protected $message = 'Class does not exist';
}