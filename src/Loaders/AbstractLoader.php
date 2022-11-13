<?php

namespace Cyntelli\DataLoader\Loaders;

use Cyntelli\DataLoader\Columns\ColumnInterface;
use Exception;

/**
 * This is an abstract class of Loader, all loader classed must extending this class and implement output method.
 *
 * @author Eric Huang <eric.huang@atelli.ai>
 */
abstract class AbstractLoader
{
    /**
     * @var array<mixed[]> $data
     */
    protected $data = [];

    /**
     * @var int $currentLength
     */
    protected $currentLength = 0;

    /**
     * @var int $currentRows
     */
    protected $currentRows = 0;

    /**
     * @var string[] $columnNames
     */
    protected $columnNames;

    /**
     * @var FileManager $fileManager
     */
    protected $fileManager;

    /**
     * output current data into specific destination
     *
     * @param string $dest
     * @return Result
     */
    abstract public function output(string $dest): Result;

    /**
     * construct
     *
     * @param bool $isColumnBase
     * @param ColumnInterface[] $columns
     */
    public function __construct(private bool $isColumnBase, protected array $columns)
    {
        foreach($columns as $col)
            $this->columnNames[] = $col->getName();
    }

    /**
     * set filename
     *
     * @param FileManager $fileManager
     * @return void
     */
    public function setFileManager(FileManager $fileManager): void
    {
        $this->fileManager = &$fileManager;
    }

    /**
     * push
     *
     * @param array<mixed> $values
     * @param bool $isAssoc default: true
     * @return void
     */
    public function push(array $values, bool $isAssoc = true): void
    {
        $length = 0;
        foreach($this->columns as $idx=>&$col) {
            $key = $idx;
            if ($isAssoc)
                $key = $col->getName();

            if (!isset($values[$key]))
                throw new Exception("Undefined $key of values");

            if (!$col->validate($values[$key]))
                throw new Exception("Invalid " . $col->getName() . "(#$idx) of values");

            $length = strlen($values[$key]);

            if ($this->isColumnBase) {
                if (!isset($this->data[$idx]))
                    $this->data[$idx] = [];

                $this->data[$idx][] = $values[$key];
            }
        }

        if (!$this->isColumnBase)
            $this->data[] = $values;

        $this->currentRows ++;
        $this->currentLength += $length;
    }

    /**
     * output current data and generate destination automatically, must set fileManager before using this method
     *
     * @return Result
     */
    public function load(): Result
    {
        if (!($this->fileManager instanceof FileManager))
            throw new Exception("Undefined fileManager");

        $dest = $this->fileManager->generate();
        return $this->output($dest);
    }

    /**
     * can load by length
     *
     * @param int $length bytes
     * @return bool
     */
    public function canLoadByLength(int $length): bool
    {
        return ($this->currentLength >= $length);
    }

    /**
     * can load by rows
     *
     * @param int $rows
     * @return bool
     */
    public function canLoadByRows(int $rows): bool
    {
        return ($this->currentRows >= $rows);
    }

    /**
     * get data
     *
     * @return array<mixed[]>
     */
    public function getData(): array
    {
        return $this->data;
    }
}