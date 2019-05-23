http://qaru.site/questions/56578/pdo-support-for-multiple-queries-pdomysql-pdomysqlnd

Поддержка PDO для нескольких запросов (PDO_MYSQL, PDO_MYSQLND)
Я знаю, что PDO не поддерживает несколько запросов, выполняемых в одном из операторов. Я был Google и нашел несколько сообщений о PDO_MYSQL и PDO_MYSQLND.

PDO_MySQL является более опасным приложения, чем любые другие традиционные Приложений MySQL. Традиционный MySQL допускает только один SQL-запрос. В PDO_MySQL нет такого ограничения, но вы рискуете быть введенными несколько запросов.

От: Защита от SQL-инъекций с использованием PDO и Zend Framework (июнь 2010 г., Julian)

Кажется, что PDO_MYSQL и PDO_MYSQLND предоставляют поддержку нескольких запросов, но я не могу найти больше информации о них. Были ли эти проекты прекращены? Есть ли способ запустить несколько запросов с помощью PDO.

84 php mysql pdo
Gajus 14 июня '11 в 19:15 источникподелиться
5 ответов
Как я знаю, PDO_MYSQLND заменил PDO_MYSQL на PHP 5.3. Сбивая с толку часть, это имя еще PDO_MYSQL. Итак, теперь ND является драйвером по умолчанию для MySQL + PDO.

В целом, для выполнения нескольких запросов сразу вам нужно:

PHP 5.3 +
mysqlnd
Эмулированные подготовленные заявления. Убедитесь, что для параметра PDO::ATTR_EMULATE_PREPARES установлено значение 1 (по умолчанию). В качестве альтернативы вы можете избежать использования подготовленных операторов и напрямую использовать $pdo->exec.
Использование exec

$db = new PDO("mysql:host=localhost;dbname=test", 'root', '');

// works regardless of statements emulation
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, 0);

$sql = "
DELETE FROM car; 
INSERT INTO car(name, type) VALUES ('car1', 'coupe'); 
INSERT INTO car(name, type) VALUES ('car2', 'coupe');
";

try {
    $db->exec($sql);
}
catch (PDOException $e)
{
    echo $e->getMessage();
    die();
}
Использование операторов

$db = new PDO("mysql:host=localhost;dbname=test", 'root', '');

// works not with the following set to 0. You can comment this line as 1 is default
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);

$sql = "
DELETE FROM car; 
INSERT INTO car(name, type) VALUES ('car1', 'coupe'); 
INSERT INTO car(name, type) VALUES ('car2', 'coupe');
";

try {
    $stmt = $db->prepare($sql);
    $stmt->execute();
}
catch (PDOException $e)
{
    echo $e->getMessage();
    die();
}


 /**
  * For SQLSTATE[HY000]: General error
  * // It's very important [0 for exec(), 1 for execute()]
  PDO::ATTR_EMULATE_PREPARES => 0, 1
*/
     private static $options = [
         PDO::ATTR_PERSISTENT => false,
         PDO::ATTR_EMULATE_PREPARES => 0, 
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
         PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
     ];
