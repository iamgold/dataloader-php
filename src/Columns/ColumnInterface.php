<?php

namespace Cyntelli\DataLoader\Columns;

use Cyntelli\DataLoader\Types\TypeInterface;

/**
 * This is a ColumnInterface, all column classes must implmenting this interface
 *
 * @author Eric Huang <eric.huang@atelli.ai>
 */
interface ColumnInterface
{
    /**
     * validate
     *
     * @param mixed $value
     * @return bool
     */
    public function validate($value): bool;

    /**
     * get column name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * get column type
     *
     * @return string
     */
    public function getColumnType(): string;

    /**
     * get type
     *
     * @return TypeInterface
     */
    public function getType(): TypeInterface;

    /**
     * get type name of data
     *
     * @return string
     */
    public function getDataType(): string;
}