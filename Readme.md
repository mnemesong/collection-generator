<h1>Mnemesong/CollectionGenerator</h1>

[![Latest Stable Version](http://poser.pugx.org/mnemesong/collection-generator/v)](https://packagist.org/packages/mnemesong/collection-generator)
[![PHPUnit](https://github.com/mnemesong/collection-generator/actions/workflows/php-unit.yml/badge.svg)](https://github.com/mnemesong/collection-generator/actions/workflows/php-unit.yml)
[![PHPStan-src-lvl9](https://github.com/mnemesong/collection-generator/actions/workflows/phpstan.yml/badge.svg)](https://github.com/mnemesong/collection-generator/actions/workflows/phpstan.yml)
[![PHPStan-test-unit-lvl5](https://github.com/mnemesong/collection-generator/actions/workflows/phpstan-tests.yml/badge.svg)](https://github.com/mnemesong/collection-generator/actions/workflows/phpstan-tests.yml)
[![PHP Version Require](http://poser.pugx.org/mnemesong/collection-generator/require/php)](https://packagist.org/packages/mnemesong/collection-generator)
[![License](http://poser.pugx.org/mnemesong/collection-generator/license)](https://packagist.org/packages/mnemesong/collection-generator)

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
    <li>Collections are completely immutable. all modifying methods create a clone of the collection with the required image
        changed composition.</li>
</ul>

<h3>RUS</h3>
<ul>
    <li>Пакет предназначен для генерации коллекций объектов.</li>
    <li>Использование коллекций упрощает использование наборов объектов, позволяет сделать код читабельнее.</li>
    <li>Использование коллекций позволяет сэкономить на валидациях, снизить кол-во ошибок, добиться персистентности набора.</li>
    <li>Использование коллекций больше соответствует объектному стилю, позволяет использовать ООП паттерны для наборов объектов.</li>
    <li>Использование коллекций позволяет применять люмбда-функции, работать с наборами более декларативно.</li>
    <li>Данный пакет призван компенсировать нехатку Дженериков и типизированных массивов в PHP.</li>
    <li>Коллекции полностью иммутабельны. все изменяющие методы создают клон поллекции с требуемым образом
        измененным составом.</li>
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
    <li><code>public function withNewOneItem(&lt;YourClass&gt; $object): self</code> - Creates a collection instance, 
        complete with specified element</li>
    <li><code>public function withManyNewItems(&lt;YourClass&gt;[] $objects): self</code> - Creates a collection instance, 
        complete with specified elements</li>
    <li><code>public function getAll(): &lt;YourClass&gt;[]</code> - Get all elements from the collection.</li>
    <li><code>public function withoutObjectsLike(&lt;YourClass&gt; $object, int $limit): void</code> - Creates 
        a collection instance, without $limit of specified objects. Equality comparison of all fields. If $limit 
        is negative then deletion starts from the end. If $limit = 0, then all occurrences of such an object are removed.</li>
    <li><code>public function filteredBy(callable $callbackFunction): self</code> - Creates an instance of the collection,
        filtered according to the specified callable function.</li>
    <li><code>public function map(callable $callbackFunction): array</code> - Returns an array of any type given
        applying the specified callable function to all elements of the collection.</li>
    <li><code>public function reworkedBy(callable $callbackFunction): void</code> - Creates an instance of a collection 
        whose elements changed by the callback function. The callable function must return an element of the same type 
        as the elements of the collection.</li>
    <li><code>public function sortedBy(callable $callbackFunction): void</code> - Creates an instance of a collection 
        whose elements sorted by the callback function using the uasort() method.</li>
    <li><code>public function count(): int</code> - Returns the number of elements in the collection</li>
    <li><code>public function jsonSerialize(): &lt;YourClass&gt;[]</code> - Returns data. available for serialization</li>
    <li><code>public function assertCount(callable $callbackFunction): self</code> - Applies a callback function 
        to the count value, throws a RuntimeException if the check is not true ($callbackFunction($count) !== true), otherwise
        returns an instance of the collection on which the method was run. Used to check the state of a collection
        in method chains.</li>
    <li><code>public function getFirstAsserted(): &lt;YourClass&gt;[]</code> - Returns the first element of the collection, 
        checking if it is not empty. Throws a RuntimeException if the first element cannot be retrieved because the collection 
        is empty.</li>
    <li><code>public function getLastAsserted(): &lt;YourClass&gt;[]</code> - Returns the last element of the collection, 
        checking if it is not empty. Throws a RuntimeException if the first element cannot be retrieved because 
        the collection is empty.</li>
    <li><code>public function getFirstOrNull(): ?&lt;YourClass&gt;[]</code> - Returns the first element of the collection, 
        or null (if empty)</li>
    <li><code>public function getLastOrNull(): ?&lt;YourClass&gt;[]</code> - Returns the last element of the collection, 
        or null (if empty)</li>
</ul>

<h3>RUS</h3>
<ul>
    <li><code>public function withNewOneItem(&lt;YourClass&gt; $object): self</code> - Создает экземпляр коллекции, дополненный
        указанным элементом</li>
    <li><code>public function withManyNewItems(&lt;YourClass&gt;[] $objects): self</code> - Создает экземпляр коллекции, 
        дополненный указанными элементами</li>
    <li><code>public function getAll(): &lt;YourClass&gt;[]</code> - Получение всех элементов из коллекции.</li>
    <li><code>public function withoutObjectsLike(&lt;YourClass&gt; $object, int $limit): void</code> - Создает экземпляр коллекции,
        без $limit указанных объектов. Сравнение по равенству всех полей. Если $limit отрицательный, то
        удаление начинается с конца. Если $limit = 0, то удаляются все вхождения подобного объекта.</li>
    <li><code>public function filteredBy(callable $callbackFunction): self</code> - Создает экземпляр коллекции, 
        отфильтрованный согласно указанной callable функции.</li>
    <li><code>public function map(callable $callbackFunction): array</code> - Возвразщает массив любого типа полученный
        применением указанной callable функции ко всем элементам коллекции.</li>
    <li><code>public function reworkedBy(callable $callbackFunction): void</code> - Создает экземпляр коллекции, 
        элементы которой изменены callback-функцией. Callable функция должна возвращать элемент того-же типа, 
        что и элементы коллекции.</li>
    <li><code>public function sortedBy(callable $callbackFunction): void</code> - Создает экземпляр коллекции, 
        элементы которой отсортированны callback-функцией методом uasort().</li>
    <li><code>public function count(): int</code> - Возвращает кол-во элементов в коллекции</li>
    <li><code>public function jsonSerialize(): &lt;YourClass&gt;[]</code> - Возвращает данные. доступные для сериализации</li>
    <li><code>public function assertCount(callable $callbackFunction): self</code> - Применяет callback-функцию 
        к значению count, выбрасывает RuntimeException в случае не истинности проверки ($callbackFunction($count) !== true),
        иначе возвращает экземпляр коллекции с которой был запущен метод. Используется для проверки состояния коллекции
        в цепочках методов.</li>
    <li><code>public function getFirstAsserted(): &lt;YourClass&gt;[]</code> - Возвращает первый элемент коллекции, проверяя 
        его непустоту. Выбрасывает RuntimeException, в случае, если нельзя получить первый элемент по причине пустоты 
        коллекции.</li>
    <li><code>public function getLastAsserted(): &lt;YourClass&gt;[]</code> - Возвращает последний элемент коллекции, 
        проверяя его непустоту. Выбрасывает RuntimeException, в случае, если нельзя получить первый элемент по причине 
        пустоты коллекции.</li>
    <li><code>public function getFirstOrNull(): ?&lt;YourClass&gt;[]</code> - Возвращает первый элемент коллекции или null 
        (если она пуста)</li>
    <li><code>public function getLastOrNull(): ?&lt;YourClass&gt;[]</code> - Возвращает последний элемент коллекции или null 
        (если она пуста)</li>
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
    <li>In the project folder, run the command: <b>composer require "mnemesong/collection-generator"</b></li>
    <li>The package will be installed to the <b>vendor/mnemesong/collection-generator</b> folder and will be available by namespace
        <b>Mnemesong\CollectionGenerator</b></li>
    <li>Alternatively, specify a package
        <b>"mnemesong/collection-generator": "*"</b> to the require section of the composer.json file and 
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
<div style="padding-left: 0"><code>{</code></div>
<div style="padding-left: 20px; color: #777;">... //some content</div>
<div style="padding-left: 20px;"><code>"scripts": {</code></div>
<div style="padding-left: 40px; color: #777;">... //some other scripts</div>
<div style="padding-left: 40px;"><code>"generate:collection": "collection-generator"</code></div>
<div style="padding-left: 20px;"><code>},</code></div>
<div style="padding-left: 20px; color: #777;">... //some content</div>
<div style="padding-left: 0"><code>}</code></div>
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
    <li>В папке проекта выполните команду: <b>composer require "mnemesong/collection-generator"</b></li>
    <li>Пакет установится в папку <b>vendor/mnemesong/collection-generator</b> и будет доступен по namespace'у 
        <b>Mnemesong\CollectionGenerator</b></li>
    <li>В качестве альтернативного способа, укажите пакет <b>"mnemesong/collection-generator": "*"</b> 
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
<div style="padding-left: 0"><code>{</code></div>
<div style="padding-left: 20px; color: #777;">... //какое-то содержание</div>
<div style="padding-left: 20px;"><code>"scripts": {</code></div>
<div style="padding-left: 40px; color: #777;">... //какие-то другие скрипты</div>
<div style="padding-left: 40px;"><code>"generate:collection": "collection-generator"</code></div>
<div style="padding-left: 20px;"><code>},</code></div>
<div style="padding-left: 20px; color: #777;">... //какое-то содержание</div>
<div style="padding-left: 0"><code>}</code></div>
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
