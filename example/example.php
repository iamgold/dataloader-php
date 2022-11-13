<?php
namespace App;

use Cyntelli\DataLoader\Loaders\{FileManager, CsvLoader, ParquetLoader};
use Cyntelli\DataLoader\Columns\Column;
use Cyntelli\DataLoader\Types\{Strings, Integer, DateTime, Email};

require __DIR__ . '/../vendor/autoload.php';

// create by definition array
$defs = [
    ['id', 'int', 0],
    ['name', 'string', '-'],
    ['gender', 'string', '-'],
    ['email', 'email', '-'],
    ['join_date', 'dateTime', '-']
];

$data = [
    [1, 'Eric', 'male', 'eric@abc.com', date('Y-m-d')],
    [2, 'Peter', 'male', 'peter@abc.com', date('Y-m-d')],
    [3, 'Marry', 'female', 'marry@abc.com', date('Y-m-d')],
    [5, 'Jenny', 'female', 'jenny@abc.com', date('Y-m-d')],
    [100, 'Mandy', 'f', 'mandy@abc.com', date('Y-m-d')],
];

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

    $columns[] = new Column($name, $typeClass);
}

$fileManager = new FileManager(__DIR__, 'csv', '20221113_');
$loader = new CsvLoader($columns, ',', true);
$loader->setFileManager($fileManager);
foreach($data as $r) {
    $loader->push($r, false);
}

echo "\n==== Row Base Data====\n";
var_dump($loader->getData());
echo "\n======== End =========\n";
$result = $loader->load();
var_dump($result);


$fileManager = new FileManager(__DIR__, 'parquet', '20221114_');
$loader = new ParquetLoader($columns);
$loader->setFileManager($fileManager);
foreach($data as $r) {
    $loader->push($r, false);
}
echo "\n==== Column Base Data====\n";
var_dump($loader->getData());
echo "\n======== End =========\n";
$result = $loader->load();
var_dump($result);
