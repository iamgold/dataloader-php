<?php

namespace Cyntelli\DataLoader\Types;

/**
 * This is a type class of Email
 *
 * @author Eric Huang <eric.huang@atelli.ai>
 * @see https://www.yiiframework.com/doc/api/2.0/yii-validators-emailvalidator
 */
class Email extends Strings
{
    /**
     * @var string the regular expression used to validate the attribute value.
     * @see https://www.regular-expressions.info/email.html
     */
    private $pattern = '/^[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+(?:\.[a-zA-Z0-9!#$%&\'*+\\/=?^_`{|}~-]+)*@(?:[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9-]*[a-zA-Z0-9])?$/';

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

        return preg_match($this->pattern, $value) !== false;
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
}
