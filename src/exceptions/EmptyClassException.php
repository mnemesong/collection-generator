<?php

namespace Mnemesong\CollectionGenerator\exceptions;

class EmptyClassException extends \ErrorException
{
    /* @phpstan-ignore-next-line  */
    protected $message = 'Classname is empty';
}