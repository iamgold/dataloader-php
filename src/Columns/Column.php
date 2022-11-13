<?php

namespace Cyntelli\DataLoader\Columns;

use Cyntelli\DataLoader\Types\TypeInterface;

/**
 * This is gernal class of column.
 *
 * @author Eric Huang <eric.huang@atelli.ai>
 */
class Column implements ColumnInterface
{
    /**
     * construct
     *
     * @param string $name name of column
     * @param TypeInterface $type
     */
    public function __construct(private string $name, private TypeInterface $type)
    {}

    /**
     * validate
     *
     * @param mixed $value
     * @return bool
     */
    public function validate($value): bool
    {
        return $this->type->validate($value);
    }

    /**
     * get column name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * get column type
     *
     * @return string
     */
    public function getColumnType(): string
    {
        return get_class($this->type);
    }

    /**
     * get type
     *
     * @return TypeInterface
     */
    public function getType(): TypeInterface
    {
        return $this->type;
    }

    /**
     * get type name of data
     *
     * @return string
     */
    public function getDataType(): string
    {
        return $this->type->getName();
    }
}