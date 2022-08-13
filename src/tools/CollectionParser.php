<?php
declare(strict_types = 1);

namespace Mnemesong\CollectionGenerator\tools;

use Mnemesong\CollectionGenerator\exceptions\ClassNotExistException;
use Mnemesong\CollectionGenerator\exceptions\EmptyClassException;

class CollectionParser
{
    protected string $fileText = '';
    protected string $baseClass = '';

    protected string $collectionsFolderName = 'collections';

    public function __construct($baseClass)
    {
        if(empty($baseClass)) {
            throw new EmptyClassException();
        }
        if(!class_exists($baseClass) && !interface_exists($baseClass)) {
            throw new ClassNotExistException('Class ' . $baseClass . ' does not exist');
        }
        $this->baseClass = $baseClass;
        $pathToFileParts = explode(DIRECTORY_SEPARATOR, __DIR__);
        $pathToFileParts[array_key_last($pathToFileParts)] = 'hidden';
        $pathToFileParts[] = 'collection';
        $pathToFileParts[] = 'ObjectObjectCollection.php';
        $this->fileText = file_get_contents(implode(DIRECTORY_SEPARATOR, $pathToFileParts));
    }

    protected function replaceNamespace(string $newNamespace): void
    {
        $this->fileText = str_replace(
            "Mnemesong\CollectionGenerator\hidden\collection",
            $newNamespace,
            $this->fileText
        );
    }

    protected function replaceClass(string $newObjectClass): void
    {
        $newObjectClassParts = explode('\\', $newObjectClass);
        $lastObjectPrefix = $this->getClassMainName($newObjectClass);
        if(empty($newObjectClass)) {
            throw new EmptyClassException();
        }
        if(empty($lastObjectPrefix)) {
            throw new EmptyClassException();
        }

        $this->fileText = str_replace(
            "Mnemesong\CollectionGenerator\hidden\ObjectObject",
            $newObjectClass,
            $this->fileText
        );
        $this->fileText = str_replace(
            "ObjectObject",
            $lastObjectPrefix,
            $this->fileText
        );
    }

    protected function getTargetDirPath(string $class): string
    {
        $reflection = new \ReflectionClass($class);
        $filePath = $reflection->getFileName();
        $filePathParts = explode(DIRECTORY_SEPARATOR, $filePath);
        $filePathParts[array_key_last($filePathParts)] = $this->collectionsFolderName;
        return implode(DIRECTORY_SEPARATOR, $filePathParts);
    }

    public function generateCollection(): void
    {
        $targetDirPath = $this->getTargetDirPath($this->baseClass);
        $this->replaceNamespace($this->calcNewNamespace($this->baseClass));
        $this->replaceClass($this->baseClass);
        if(!is_dir($targetDirPath)) {
            mkdir($targetDirPath);
        }
        $filePath = $targetDirPath . DIRECTORY_SEPARATOR . $this->getClassMainName($this->baseClass) . 'Collection.php';
        file_put_contents($filePath, $this->fileText);
    }

    protected function getClassMainName(string $class): string
    {
        $classParts = explode('\\', $class);
        return end($classParts);
    }

    protected function calcNewNamespace(string $class): string
    {
        $classParts = explode('\\', $class);
        $classParts[array_key_last($classParts)] = $this->collectionsFolderName;
        return implode('\\', $classParts);
    }

}