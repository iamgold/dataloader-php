<?php

namespace Cyntelli\DataLoader\Types;

/**
 * This is a TypeInterface, all type class must implmenting this interface
 *
 * @author Eric Huang <eric.huang@atelli.ai>
 */
interface TypeInterface
{
    /**
     * validate
     *
     * @param mixed $value
     * @return bool
     */
    public function validate($value): bool;

    /**
     * get name
     *
     * @return string
     */
    public function getName(): string;
}