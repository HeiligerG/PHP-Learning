# Datenbankanbindung

Um mit PHP auf eine Datenbank zuzugreifen verwenden wir [`PHP Data Objects`](http://php.net/book.pdo) (kurz PDO).

Die von PHP zur Verfügung gestellte PDO-Klasse stellt ein einheitliches Interface zur Anbindung unterschiedlicher Datenbanktypen bereit.

## Verbindung herstellen

```php
$user = 'root';
$password = '';
$database = 'tasklist';

$pdo = new PDO('mysql:host=localhost;dbname=' . $database, $user, $password, [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);
```

## Select

```php
$stmt = $pdo->query('SELECT * FROM `users`');
foreach($stmt->fetchAll() as $x) {
    var_dump($x);
}
```

## Insert

```php
$count = $pdo->exec("INSERT INTO `tasks` (description) VALUES ('Geschirr abwaschen')");
echo "$count Datensätze wurden eingefügt.";
```

## Update

```php
$count = $pdo->exec("UPDATE `tasks` SET done = 1 WHERE id = 50");
echo "$count Datensätze wurden geändert.";
```

## Delete

```php
$count = $pdo->exec("DELETE FROM `tasks` WHERE done = 1");
echo "$count Datensätze wurden gelöscht.";
```

## Prepared-Statements
Um SQL-Injection zu verhindern, sollte ausschliesslich mit  [`Prepared-Statements`](https://de.wikipedia.org/wiki/Prepared_Statement) gearbeitet werden. 
### Select
```php
$stmt = $pdo->prepare('SELECT * FROM `users` WHERE id = :id');
$stmt->execute([':id' => 1]);

foreach($stmt->fetchAll() as $x) {
    var_dump($x);
}
```
### Insert
```php
$stmt = $pdo->prepare("INSERT INTO `users` (first_name, last_name) VALUES(:first, :last) ");
$stmt->execute([':first' => $firstname, ':last' => $lastname]);
```
