Roman Numeral Converter
==========================

# Description

This repo implements two ways to convert an Arabic number to a Roman Number. The first one is a more direct way to convert these numbers using math and some arrays to map values.

The other one decouples the value by its units, tens, hundreds, and thousands. After that, these values are mapped to your specific values in Roman Numbers.

There's no visible performance difference between both implementations, and it was needed just two simple classes to implement them.

# Requirements

- [Docker](https://docs.docker.com/install/)
- [Docker Compose](https://docs.docker.com/compose/install/)*

*The Docker Compose installation is necessary if you don't have PHP 7.2 installed in your machine (host) and don't wanna install it*.

# Installing Dependencies

## Docker Compose

```bash
# Installing dependencies
$ docker run --rm --interactive --tty --volume $PWD:/app composer install
```

## Directly in the host

```bash
# Installing dependencies
$ cd project_path/
$ php composer.phar install
```

# Running tests

## Docker Compose

```bash
# Running all tests
$ docker run -it --rm -v "$PWD":/usr/src/app -w /usr/src/app php:7.2-cli php /usr/src/app/vendor/bin/phpunit tests
```

```bash
# Running a specific class test
$ docker run -it --rm -v "$PWD":/usr/src/app -w /usr/src/app php:7.2-cli php /usr/src/app/vendor/bin/phpunit tests/MapperTest.php
```

## Directly in the host

```bash
# Running all tests
$ cd project_path/
$ php /vendor/bin/phpunit tests
```

```bash
# Running a specific class test
$ cd project_path/
$ php /vendor/bin/phpunit tests/MapperTest.php
```

## Running app

There's a demo file in root path that tests some values.

```php
<?php

/**
 * @author Mateus Schmitz <matteuschmitz@gmail.com>
 * @package Demo
 */

require('./vendor/autoload.php');

$demoValues = [10, 100, 1000, 22, 36, 50, 51, 55, 114, 500, 430, 509, 510, 1786, 1590, 3098, 3999];

foreach ($demoValues as $value) {

    $decoupledValues = \RomanNumeralConvertion\Utils::decoupleValue($value);
    $romanValues     = array_map(function ($value) {return \RomanNumeralConvertion\Mapper::mapToRoman($value);}, $decoupledValues);

    echo "Input: " . $value . "\n";
    echo "    Output Custom: " . implode('', $romanValues) . "\n";
    echo "    Output Classic: " . \RomanNumeralConvertion\Mapper::mapToRomanClassicWay($value) . "\n";
}

echo "\nMemory Usage: " . memory_get_peak_usage(true) . " Bytes";
```

To exec this file you can run the following:

```bash
$ docker run -it --rm -v "$PWD":/usr/src/app -w /usr/src/app php:7.2-cli php /usr/src/app/demo.php
```

Or, if you're running from host:

```bash
$ cd project_path/
$ php demo.php
```

You can run tests with other values through the CLI command:

```bash
# Running with Docker Compose
$ docker run -it --rm -v "$PWD":/usr/src/app -w /usr/src/app php:7.2-cli php /usr/src/app/run.php [NUMBER_TO_BE_CONVERTED]
```

```bash
# Running directly in the host
$ cd project_path/
$ php run.php [NUMBER_TO_BE_CONVERTED]
```
