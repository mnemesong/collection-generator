<?php
declare(strict_types = 1);

namespace Mnemesong\CollectionGenerator\tools;

use Mnemesong\CollectionGenerator\exceptions\ClassNotExistException;
use Mnemesong\CollectionGenerator\exceptions\EmptyClassException;
use Webmozart\Assert\Assert;

class CollectionParser
{
    protected string $fileText = '';
    /* @var class-string $baseClass */
    protected string $baseClass = '';

    protected string $collectionsFolderName = 'collections';

    /**
     * @param class-string $baseClass
     * @throws EmptyClassException
     */
    public function __construct(string $baseClass)
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
        $fileContents = file_get_contents(implode(DIRECTORY_SEPARATOR, $pathToFileParts));
        Assert::notFalse($fileContents, "Can't get contents of collection-derivative class");
        $this->fileText = $fileContents;
    }

    /**
     * @param string $newNamespace
     * @return void
     */
    protected function replaceNamespace(string $newNamespace): void
    {
        $this->fileText = str_replace(
            "Mnemesong\CollectionGenerator\hidden\collection",
            $newNamespace,
            $this->fileText
        );
    }

    /**
     * @param string $newObjectClass
     * @return void
     * @throws EmptyClassException
     */
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

    /**
     * @param class-string $class
     * @return string
     * @throws \ReflectionException
     */
    protected function getTargetDirPath(string $class): string
    {
        $reflection = new \ReflectionClass($class);
        $filePath = $reflection->getFileName();
        Assert::notFalse($filePath, "Can't get file-path of collection-derivative class");
        $filePathParts = explode(DIRECTORY_SEPARATOR, $filePath);
        $filePathParts[array_key_last($filePathParts)] = $this->collectionsFolderName;
        return implode(DIRECTORY_SEPARATOR, $filePathParts);
    }

    /**
     * @return void
     * @throws EmptyClassException
     * @throws \ReflectionException
     */
    public function generateCollection(): void
    {
        /* @phpstan-ignore-next-line */
        $targetDirPath = $this->getTargetDirPath($this->baseClass);
        $this->replaceNamespace($this->calcNewNamespace($this->baseClass));
        $this->replaceClass($this->baseClass);
        if(!is_dir($targetDirPath)) {
            mkdir($targetDirPath);
        }
        $filePath = $targetDirPath . DIRECTORY_SEPARATOR . $this->getClassMainName($this->baseClass) . 'Collection.php';
        file_put_contents($filePath, $this->fileText);
    }

    /**
     * @param string $class
     * @return string
     */
    protected function getClassMainName(string $class): string
    {
        $classParts = explode('\\', $class);
        return end($classParts);
    }

    /**
     * @param string $class
     * @return string
     */
    protected function calcNewNamespace(string $class): string
    {
        $classParts = explode('\\', $class);
        $classParts[array_key_last($classParts)] = $this->collectionsFolderName;
        return implode('\\', $classParts);
    }

}