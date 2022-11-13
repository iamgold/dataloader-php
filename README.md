# Data Loader
This is a lightweight, simple and flexible library for exporting data, and now support csv, tsv, parquet etc....

## Getting Start
### Features
- Support csv
- Support tsv
- Support parquet
### Requirements
- PHP 8.0+
- ext-snappy (optional when using ParquetLoader and Snappy compression method)
- ext-zip
### Install
```php=
composer require iamgold/dataloader-php
```
### Usage
```php=
// prepare column definitions
$defs = [
    ['id', 'int', 0], // name, type, defaultValue
    ['name', 'string', '-'],
    ['gender', 'string', '-'],
    ['email', 'email', '-'],
    ['join_date', 'dateTime', '-']
];

// prepare columns for each definitions and mapping related type calss.
$columns = [];
foreach($defs as $def) {
    list($name, $type, $defaultValue) = $def;
    $typeClass = match ($type) {
        'int' => new Integer,
        'string' => new Strings,
        'dateTime' => new DateTime,
        'email' => new Email,
        default => null,
    };

    if ($typeClass === null)
        die("The type($type) doest't support");

    // create column by name and type
    $columns[] = new Column($name, $typeClass);
}

// prepare data
$data = [
    [1, 'Eric', 'male', 'eric@abc.com', date('Y-m-d')],
    [2, 'Peter', 'male', 'peter@abc.com', date('Y-m-d')],
    [3, 'Marry', 'female', 'marry@abc.com', date('Y-m-d')],
    [5, 'Jenny', 'female', 'jenny@abc.com', date('Y-m-d')],
    [100, 'Mandy', 'f', 'mandy@abc.com', date('Y-m-d')],
];

// create a file manager for storing file
$fileManager = new FileManager(__DIR__, 'csv', '20221113_');

// create loader for collecting data and parsing into columns
$loader = new CsvLoader($columns, ',', true);
$loader->setFileManager($fileManager);

// push data
foreach($data as $r) {
    $loader->push($r, false);
}

// load by file manager
$result = $loader->load();
```
### Documents

- [html](https://github.com/iamgold/dataloader-php/tree/main/docs).

comming soon...

