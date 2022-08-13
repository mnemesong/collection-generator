<?php

namespace Mnemesong\CollectionGenerator\exceptions;

class ClassNotExistException extends \RuntimeException
{
    protected $message = 'Class does not exist';
}