Number generator for simple cases
=================================

This package provides a very simple number generator that relies on a
local Sqlite database. This tool simplifies the tasks of creating
consecutive numbers and saving the time when they got created.

It might be helpful when implementing a very simple order system with the
need to create unique and traceable numbers to identify invoices or other
order documents for later processing.

Installation
-----
```
composer require nicolask/numerator
```

Usage
-----

``` php
$factory = new NumberFactory($pathToDb);
$nextNumber = $factory->getNextNumber();
```

