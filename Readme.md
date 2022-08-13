<h1>Pantagruel74/CollectionGenerator</h1>

----
<h2>Language / Язык</h2>
<ul>
    <li>All descriptions in that package duplicated on two languages: English and Russian.</li>
    <li>Все описания и появнения к данному пакету дублируются на двух языках: Русском и Английском.</li>
</ul>

----
<h2>Description / Описание</h2>
<h3>ENG</h3>
<ul>
    <li>The package is designed to generate collections of objects.</li>
    <li>Using collections simplifies the use of sets of objects, allows you to make the code more readable.</li>
    <li>Using collections allows you to save on validations, reduce the number of errors, and achieve set persistence.</li>
    <li>Using collections is more in line with the object style, allows you to use OOP patterns for collections of objects.</li>
    <li>Using collections allows you to use lambda functions, work with sets more declaratively.</li>
    <li>This package is intended to compensate for the lack of generics and typed arrays in PHP.</li>
</ul>

<h3>RUS</h3>
<ul>
    <li>Пакет предназначен для генерации коллекций объектов.</li>
    <li>Использование коллекций упрощает использование наборов объектов, позволяет сделать код читабельнее.</li>
    <li>Использование коллекций позволяет сэкономить на валидациях, снизить кол-во ошибок, добиться персистентности набора.</li>
    <li>Использование коллекций больше соответствует объектному стилю, позволяет использовать ООП паттерны для наборов объектов.</li>
    <li>Использование коллекций позволяет применять люмбда-функции, работать с наборами более декларативно.</li>
    <li>Данный пакет призван компенсировать нехатку Дженериков и типизированных массивов в PHP.</li>
</ul>

----
<h2>Usage / Использование</h2>
<h3>ENG</h3>
<ul>
    <li>Use the Mnemesong\CollectionGenerator\CollectionGenerator->generateForClass(&lt;YourClassFullName&gt;) object method.</li>
    <li>This method will generate the class &lt;YourClassNamespace&gt;\collections\&lt;YourClassShortName&gt;Collection into the appropriate directory.</li>
    <li>For convenience, create a command in your CLI to generate collections using CollectionGenerator.</li>
    <li>When installed via composer, a CLI script is generated: /vendor/bin/collection-generator,
    which can also be used to generate collections. See the "Installation" section for details on setting up and using it. </li>
</ul>

<h3>RUS</h3>
<ul>
    <li>Используйте метод объекта Mnemesong\CollectionGenerator\CollectionGenerator->generateForClass(&lt;YourClassFullName&gt;).</li>
    <li>Даннный метод сгенерирует класс &lt;YourClassNamespace&gt;\collections\&lt;YourClassShortName&gt;Collection в соответствующую директорию.</li>
    <li>Для удобства, создайте в вашем CLI команду, для генерации коллекиций, используя CollectionGenerator.</li>
    <li>При установке через композер генерируется CLI-скрипт: /vendor/bin/collection-generator, 
    который тоже можно использовать для генерации коллекций. Подробнее о его настройке и использовании смотрите в разделе "Установка". </li>
</ul>

----
<h2>Collections methods / Методы коллекций</h2>
<h3>ENG</h3>
<ul>
    <li>public function add(&lt;YourClass&gt; $object): void - adding an element to the collection.</li>
    <li>public function getAll(): &lt;YourClass&gt;[] - getting all elements from the collection.</li>
    <li>public function removeObject(&lt;YourClass&gt; $object): void - remove an element from the collection.</li>
    <ul>
        <li>Non-strict comparison "==" is used for searching.</li>
        <li>The first occurrence is removed.</li>
    </ul>
    <li>public function removeAll(&lt;YourClass&gt; $object): int - removal of all such elements from the collection.</li>
    <ul>
        <li>Non-strict comparison "==" is used for searching.</li>
        <li>All occurrences are removed.</li>
    </ul>
    <li>public function filter(callable $callbackFunction): self - filters the objects in the array.</li>
    <ul>
        <li>The result is returned as a new collection.</li>
        <li>The original collection remains unchanged.</li>
    </ul>
    <li>public function map(callable $callbackFunction): array - Converts a set from a collection to a new set and returns it.</li>
    <ul>
        <li>The result is returned as an array of new objects.</li>
        <li>The original collection remains unchanged.</li>
    </ul>
    <li>public function apply(callable $callbackFunction): void - Applies the callback function to all elements of the collection.</li>
    <ul>
        <li>Modifies the elements of the original collection.</li>
        <li>The callback function must return an object of the same type as the base type of the collection (&lt;YourClass&gt;).</li>
    </ul>
    <li>public function count(): int - returns the number of elements in the collection</li>
    <li>public function getByIndex(int $index): ?&lt;YourClass&gt; - returns an element of the collection by its index</li>
    <li>public function getNextIndex(int $index): ?int - Returns the index of the next element</li>
    <li>public function getFirstIndex(): int - Returns the index of the first element</li>
    <li>public function getIterator(): \Iterator - Returns an iterator</li>
    <li>public function jsonSerialize(): &lt;YourClass&gt;[] - Returns data. available for serialization</li>
    <li>public function getFirst(): &lt;YourClass&gt;[] - Returns the first element of the collection</li>
    <ul>
        <li>Throws a RuntimeException if the collection is empty</li>
    </ul>
    <li>public function getLast(): &lt;YourClass&gt;[] - Returns the last element of the collection</li>
    <ul>
        <li>Throws a RuntimeException if the collection is empty</li>
    </ul>
    <li>public function getFirstOrNull(): ?&lt;YourClass&gt;[] - Returns the first element of the collection, or null (if empty)</li>
    <li>public function getLastOrNull(): ?&lt;YourClass&gt;[] - Returns the last element of the collection, or null (if empty)</li>
</ul>
<h4>Assertion methods</h4>
<p>Allows you to declare checks inside filter/get call chains.
If the collection does not meet the specified requirements, it raises an error (AssertionError by default).
Avoids invariant calls to the next methods in the chain after filtering or removing from the collection
multiple elements.</p>
<ul>
    <li>public function assertCountEquals(int $count, ?\Error $error = null): &lt;YourClass&gt;Collection
        - Checks that the collection has exactly $count elements</li>
    <li>public function assertCountNotEquals(int $count, ?\Error $error = null): &lt;YourClass&gt;Collection
        - Checks that the collection contains exactly no $count elements</li>
    <li>public function assertCountGreaterThen(int $count, ?\Error $error = null): &lt;YourClass&gt;Collection
        - Checks that the collection has strictly more than $count elements</li>
    <li>public function assertCountNotGreaterThen(int $count, ?\Error $error = null): &lt;YourClass&gt;Collection
        - Checks that the collection has no more (less than or equal) than $count elements</li>
    <li>public function assertCountLesserThen(int $count, ?\Error $error = null): &lt;YourClass&gt;Collection
        - Checks that the collection has strictly less than $count elements</li>
    <li>public function assertCountNotLesserThen(int $count, ?\Error $error = null): &lt;YourClass&gt;Collection
        - Checks that the collection has at least (greater than or equal to) $count elements</li>
</ul>

<h3>RUS</h3>
<ul>
    <li>public function add(&lt;YourClass&gt; $object): void - добавление элемента в коллекцию.</li>
    <li>public function getAll(): &lt;YourClass&gt;[] - получение всех элементов из коллекции.</li>
    <li>public function removeObject(&lt;YourClass&gt; $object): void - удаление элемента из коллекции.</li>
    <ul>
        <li>Для поиска используется нестрогое сравнение "==").</li>
        <li>Удаляется первое вхождение.</li>
    </ul>
    <li>public function removeAll(&lt;YourClass&gt; $object): int - удаление всех подобных элементов из коллекции.</li>
    <ul>
        <li>Для поиска используется нестрогое сравнение "==").</li>
        <li>Удаляются все вхождения.</li>
    </ul>
    <li>public function filter(callable $callbackFunction): self - фильтрует объекты в массиве.</li>
    <ul>
        <li>Результат возвращается в виде новой коллекции.</li>
        <li>Исходная коллекция остается неизменной.</li>
    </ul>
    <li>public function map(callable $callbackFunction): array - Преобразует набор из коллекции в новый набор и возвращает его.</li>
    <ul>
        <li>Результат возвращается в виде массива новых объектов.</li>
        <li>Исходная коллекция остается неизменной.</li>
    </ul>
    <li>public function apply(callable $callbackFunction): void - Применяет callback-функцию ко всем элементам коллекции.</li>
    <ul>
        <li>Изменяет элементы исходной коллекции.</li>
        <li>Callback функиця должна возвращать объект соответствующего типа, что и базовый тип коллекции (&lt;YourClass&gt;).</li>
    </ul>
    <li>public function count(): int - возврящает кол-во элементов в коллекции</li>
    <li>public function getByIndex(int $index): ?&lt;YourClass&gt; - возвращает элемент коллекции по его индексу</li>
    <li>public function getNextIndex(int $index): ?int - Возвращает индекс следующего элемента</li>
    <li>public function getFirstIndex(): int - Возвращает индекс первого элемента</li>
    <li>public function getIterator(): \Iterator - Возвращает итератор</li>
    <li>public function jsonSerialize(): &lt;YourClass&gt;[] - Возвращает данные. доступные для сериализации</li>
    <li>public function getFirst(): &lt;YourClass&gt;[] - Возвращает первый элемент коллекции</li>
    <ul>
        <li>Выбрасывает RuntimeException если коллекция пуста</li>
    </ul>
    <li>public function getLast(): &lt;YourClass&gt;[] - Возвращает последний элемент коллекции</li>
    <ul>
        <li>Выбрасывает RuntimeException если коллекция пуста</li>
    </ul>
    <li>public function getFirstOrNull(): ?&lt;YourClass&gt;[] - Возвращает первый элемент коллекции или null (если она пуста)</li>
    <li>public function getLastOrNull(): ?&lt;YourClass&gt;[] - Возвращает последний элемент коллекции или null (если она пуста)</li>
</ul>
<h4>Assertion-методы</h4>
<p>Позволяют объявлять проверки внутри filter/get цепочек вызовов. 
Если коллекция не соответствует указанным требованиям - вызывает ошибку (по умолчанию AssertionError).
Позволяет избежать инвариантных вызовов следующих в цепочке методов, после фильтрации или удаления из коллекции 
нескольких элментов.</p>
<ul>
    <li>public function assertCountEquals(int $count, ?\Error $error = null): &lt;YourClass&gt;Сollection 
        - Проверяет, что в коллекции ровно $count элементов</li>
    <li>public function assertCountNotEquals(int $count, ?\Error $error = null): &lt;YourClass&gt;Сollection 
        - Проверяет, что в коллекции ровно не $count элементов</li>
    <li>public function assertCountGreaterThen(int $count, ?\Error $error = null): &lt;YourClass&gt;Сollection 
        - Проверяет, что в коллекции строго больше чем $count элементов</li>
    <li>public function assertCountNotGreaterThen(int $count, ?\Error $error = null): &lt;YourClass&gt;Сollection 
        - Проверяет, что в коллекции не больше (меньше либо равно) чем $count элементов</li>
    <li>public function assertCountLesserThen(int $count, ?\Error $error = null): &lt;YourClass&gt;Сollection 
        - Проверяет, что в коллекции строго меньше чем $count элементов</li>
    <li>public function assertCountNotLesserThen(int $count, ?\Error $error = null): &lt;YourClass&gt;Сollection 
        - Проверяет, что в коллекции не меньше (больше либо равно) чем $count элементов</li>
</ul>

----
<h2>Requirements / Требования</h2>
<ul>
    <li>PHP: >=7.4</li>
</ul>

----
<h2>Installation / Установка</h2>
<h3>ENG</h3>
<h4>Install via Composer</h4>
<ul>
    <li>In the project folder, run the command: <b>composer require "pantagruel74/collection-generator"</b></li>
    <li>The package will be installed to the <b>vendor/pantagruel74/collection-generator</b> folder and will be available by namespace
        <b>Mnemesong\CollectionGenerator</b></li>
    <li>Alternatively, specify a package
        <b>"pantagruel74/collection-generator": "*"</b> to the require section of the composer.json file and 
        run the command: <b>composer update</b></li>
</ul>
<h4>Usage with composer CLI (terminal)</h4>
It is possible to use the composer terminal to generate collections. For this:
<ul>
    <li>Install the package with composer as above</li>
    <li>In the composer.json file, find or create a "scripts" section: {...}</li>
    <li>In the scripts section, add the value: "generate:collection": "collection-generator"</li>
    <li>The final content of the section should look like this:</li>
</ul>
<div style="padding-left: 0; color: #777;">//composer.json file:</div>
<div style="padding-left: 0">{</div>
<div style="padding-left: 20px; color: #777;">... //some content</div>
<div style="padding-left: 20px;">"scripts": {</div>
<div style="padding-left: 40px; color: #777;">... //some other scripts</div>
<div style="padding-left: 40px;">"generate:collection": "collection-generator"</div>
<div style="padding-left: 20px;">},</div>
<div style="padding-left: 20px; color: #777;">... //some content</div>
<div style="padding-left: 0">}</div>
<ul>
    <li>Update the application configuration with the command: <b>composer update</b></li>
    <li>Test the script with <b>composer generate:collection</b>.
        You should get the message <b>"Not point class for collection generation"</b> - 
        it means the script is connected correctly</li>
    <li>Use the command: <b>composer generate:collection &lt;Full class name including namespace&gt;</b> 
        to generate a collection for this class.</li>
    <li>In case of successful generation, the terminal will display the line <b>Success!</b></li>
    <li>A collections folder will be created in the folder with the original class, the created collection will 
        be located in it.</li>
</ul>

<h3>RUS</h3>
<h4>Установка через Composer</h4>
<ul>
    <li>В папке проекта выполните команду: <b>composer require "pantagruel74/collection-generator"</b></li>
    <li>Пакет установится в папку <b>vendor/pantagruel74/collection-generator</b> и будет доступен по namespace'у 
        <b>Mnemesong\CollectionGenerator</b></li>
    <li>В качестве альтернативного способа, укажите пакет <b>"pantagruel74/collection-generator": "*"</b> 
        в секцию require фала composer.json и выполните команду: <b>composer update</b></li>
</ul>
<h4>Использование с помощью composer CLI (терминала)</h4>
Существует возможность использования composer-терминала для генерации коллекций. Для этого:
<ul>
    <li>Установите пакет с помощью composer как указано выше</li>
    <li>В файле composer.json найдите или создайте секцию "scripts": {...}</li>
    <li>В секции scripts добавьте значение: "generate:collection": "collection-generator"</li>
    <li>Итоговое содержание секции должно выглядеть так:</li>
</ul>
<div style="padding-left: 0; color: #777;">//composer.json файл:</div>
<div style="padding-left: 0">{</div>
<div style="padding-left: 20px; color: #777;">... //какое-то содержание</div>
<div style="padding-left: 20px;">"scripts": {</div>
<div style="padding-left: 40px; color: #777;">... //какие-то другие скрипты</div>
<div style="padding-left: 40px;">"generate:collection": "collection-generator"</div>
<div style="padding-left: 20px;">},</div>
<div style="padding-left: 20px; color: #777;">... //какое-то содержание</div>
<div style="padding-left: 0">}</div>
<ul>
    <li>Обновите конфигурацию приложения командой: <b>composer update</b></li>
    <li>Проверьте работу скрипта командой <be>composer generate:collection</be>.
        Вы должны получить сообщение <b>"Not point class for collection generation"</b> - значит скрипт подключен корректно</li>
    <li>Используйте команду: <b>composer generate:collection &lt;Полное имя класса включая namespace&gt;</b> для генерации коллекции для этого класса.</li>
    <li>В случае успешной генерации в терминале отобразится строка <b>Success!</b></li>
    <li>В папке с исходным классом будет создана папка collections, созданная коллекция будет находиться в ней.</li>
</ul>

----
<h2>License / Лицензия</h2>
<ul>
    <li>MIT</li>
</ul>

----
<h2>Author / Автор</h2>
<ul>
    <li>Anatoly Starodubtsev</li>
    <li>Email: tostar74@mail.ru</li>
</ul>
