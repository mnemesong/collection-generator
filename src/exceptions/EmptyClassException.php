<?php

namespace Mnemesong\CollectionGenerator\exceptions;

class EmptyClassException extends \ErrorException
{
    protected $message = 'Classname is empty';
}