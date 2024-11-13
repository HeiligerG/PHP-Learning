# Formularvalidation mit respect/validation lösen

## Aufgabenstellung

Schreibe den Validierungs-Code deines Formulars mit Hilfe der Bibliothek [`respect/validation`](https://packagist.org/packages/respect/validation) neu.

## Lösungshilfe

Installiere die Bibliothek in deinem Projekt via Composer.

```
# in einer Kommandozeile
cd pfad\zu\deinem\projekt
composer require respect/validation
```

In deinem Projekt ist nun ein neuer Ordner `vendor` erstellt worden. Darin findest Du eine `autoload.php`. Diese muss am Beginn deiner Anwendung eingebunden werden.

```php
// index.php
require 'vendor/autoload.php';
```

Du kannst die Validator-Klasse nun über folgendes `use` Statement nutzen:

```php
// index.php
require 'vendor/autoload.php';

use Respect\Validation\Validator as v;
```

Jetzt hast du die Möglichkeit die vielen Validator-Funktionen für dein Formular zu nutzen:

```php
// Ist der Name mindestens 1 Zeichen lang?
if( ! v::length(1)->validate($data['name']) {
    echo "Bitte gib einen Namen ein!";
}

// Wurde eine Email-Adresse eingegeben?
if( ! v::email()->validate($data['email']) {
    echo "Bitte gib eine gültige Email ein!";
}
```

Eine Liste aller verfügbarer Validatoren findest du hier:

[https://github.com/Respect/Validation/blob/master/docs/VALIDATORS.md](https://github.com/Respect/Validation/blob/master/docs/VALIDATORS.md)

