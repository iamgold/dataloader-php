<?php

namespace Cyntelli\DataLoader\Types;

/**
 * This is a type class of String
 *
 * @author Eric Huang <eric.huang@atelli.ai>
 */
class Strings implements TypeInterface
{
    /**
     * validate
     *
     * @param mixed $value
     * @return bool
     */
    public function validate(mixed $value): bool
    {
        if (!is_string($value))
            return false;

        return true;
    }

    /**
     * get name
     *
     * @return string
     */
    public function getName(): string
    {
        return 'string';
    }

    /**
     * get type name of parquet
     *
     * @return string
     */
    public function getParquetTypeName(): string
    {
        return 'string';
    }
}
