<?php

namespace Cyntelli\DataLoader\Types;

/**
 * This is a type class of Float
 *
 * @author Eric Huang <eric.huang@atelli.ai>
 */
class Float implements TypeInterface
{
    /**
     * validate
     *
     * @param mixed $value
     * @return bool
     */
    public function validate(mixed $value): bool
    {
        if (!is_float($value))
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
        return 'float';
    }
}
