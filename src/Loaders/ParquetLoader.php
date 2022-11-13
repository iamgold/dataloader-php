<?php

namespace Cyntelli\DataLoader\Loaders;

use Cyntelli\DataLoader\Columns\ColumnInterface;
use Exception;
use codename\parquet\{ParquetWriter, CompressionMethod};
use codename\parquet\data\Schema;
use codename\parquet\data\DataField;
use codename\parquet\data\DataColumn;

/**
 * This is a Parquet loader
 *
 * @author Eric Huang <eric.huang@atelli.ai>
 */
class ParquetLoader extends AbstractLoader
{
    /**
     * @var array<string, int> compressionMethods
     */
    protected $compressionMethods = [
        'zip' => CompressionMethod::Gzip,
        'snappy' => CompressionMethod::Snappy,
        'none' => CompressionMethod::None
    ];

    /**
     * @var string COMPRESSION_METHOD_ZIP
     */
    const COMPRESSION_METHOD_ZIP = 'zip';

    /**
     * @var string COMPRESSION_METHOD_SNAPPY
     */
    const COMPRESSION_METHOD_SNAPPY = 'snappy';

    /**
     * @var string COMPRESSION_METHOD_NONE
     */
    const COMPRESSION_METHOD_NONE = 'none';

    /**
     * construct
     *
     * @param ColumnInterface[] $columns
     * @param string $compressionMethod default: zip
     */
    public function __construct(protected array $columns, private string $compressionMethod = 'zip')
    {
        // set column oriented
        parent::__construct(true, $columns);

        // check method
        if (!isset($this->compressionMethods[$compressionMethod]))
            throw new Exception("Invalid compression method($compressionMethod)");
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

            $columns = [];
            $schemas = [];
            foreach($this->columns as $idx=>&$column) {
                $dataColumn = new DataColumn(DataField::createFromType($column->getName(), $column->getDataType()), $this->data[$idx]);
                $schemas[] = $dataColumn->getField();
                $columns[] = $dataColumn;
            }

            $schema = new Schema($schemas);
            $parquetWriter = new ParquetWriter($schema, $fp);
            // set compression method
            $parquetWriter->compressionMethod = $this->compressionMethods[$this->compressionMethod];

            // create a new row group in the file
            $groupWriter = $parquetWriter->CreateRowGroup();

            foreach($columns as &$col)
                $groupWriter->WriteColumn($col);

            $groupWriter->finish();
            $parquetWriter->finish();
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