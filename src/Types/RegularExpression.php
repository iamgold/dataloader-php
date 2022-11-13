<?php

namespace Cyntelli\DataLoader\Types;

/**
 * This is a type class of Regular Expression
 *
 * @author Eric Huang <eric.huang@atelli.ai>
 */
class RegularExpression implements TypeInterface
{
    /**
     * construct
     *
     * @param string $pattern
     * @param string $name
     */
    public function __construct(private string $pattern, private string $name = 'string')
    {}

    /**
     * validate
     *
     * @param mixed $value
     * @return bool
     */
    public function validate(mixed $value): bool
    {
        return preg_match($this->pattern, $value) !== false;
    }

    /**
     * get name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
