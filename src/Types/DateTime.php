<?php

namespace Cyntelli\DataLoader\Types;

/**
 * This is a type class of DateTime
 *
 * @author Eric Huang <eric.huang@atelli.ai>
 */
class DateTime extends Strings
{
    /**
     * construct
     *
     * @param string $format default: Y-m-d
     */
    public function __construct(private string $format = 'Y-m-d', private string $name = 'string')
    {}

    /**
     * validate
     *
     * @param mixed $value
     * @return bool
     */
    public function validate(mixed $value): bool
    {
        if (!parent::validate($value))
            return false;

        $ts = strtotime($value);
        if (empty($ts))
            return false;

        return $value === date($this->format, $ts);
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
