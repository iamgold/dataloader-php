<?php

namespace Cyntelli\DataLoader\Loaders;

use Cyntelli\DataLoader\Columns\ColumnInterface;
use Exception;

/**
 * This is a CSV loader
 *
 * @author Eric Huang <eric.huang@atelli.ai>
 */
class CsvLoader extends AbstractLoader
{
    /**
     * construct
     *
     * @param ColumnInterface[] $columns
     * @param string $seperator default: ','
     * @param bool $outputWithHeader default: true
     */
    public function __construct(array $columns, private string $seperator = ',', private bool $outputWithHeader = true)
    {
        parent::__construct(false, $columns);
    }

    /**
     * output current data into specific destination
     *
     * @param string $dest
     * @return Result
     */
    public function output(string $dest): Result
    {
        try {
            @unlink($dest);
            $count = 0;
            $fp = fopen($dest, 'a+');
            if (!is_resource($fp))
                throw new Exception("The file($dest) can't be create");

            if ($this->outputWithHeader)
                fputcsv($fp, $this->columnNames, $this->seperator);

            foreach($this->data as $values) {
                fputcsv($fp, $values, $this->seperator);
            }
            fclose($fp);

            $result = new Result($this->currentLength, $this->currentRows, $dest);
            $this->currentLength = 0;
            $this->currentRows = 0;
            $this->data = [];
            return $result;
        } catch (Exception $e) {
            throw $e;
        }

    }
}