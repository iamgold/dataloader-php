<?php

namespace Cyntelli\DataLoader\Types;

/**
 * This is a type class of Integer
 *
 * @author Eric Huang <eric.huang@atelli.ai>
 */
class Integer implements TypeInterface
{
    /**
     * validate
     *
     * @param mixed $value
     * @return bool
     */
    public function validate(mixed $value): bool
    {
        if (!is_int($value))
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
        return 'integer';
    }
}
