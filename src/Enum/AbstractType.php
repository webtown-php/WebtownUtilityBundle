<?php

namespace Webtown\UtilityBundle\Enum;

/**
 * Class AbstractType
 *
 * Ha státuszt vagy állapotot szeretnénk tárolni, akkor ebből származtassuk az objektumot.
 *
 * @package Webtown\UtilityBundle\Enum
 */
abstract class AbstractType
{
    public static $types;

    protected $type;

    public function __construct($type)
    {
        $this->setType($type);
    }

    public function __toString()
    {
        return static::$types[$this->type];
    }

    public function getType()
    {
        return $this->type;
    }

    protected function setType($type)
    {
        // checks if the type is string, but skips it if it can be converted to int "1" -> 1
        if (is_string($type) && (int) $type === 0) {
            $types = array_flip(static::$types);
            $type = isset($types[$type]) ? $types[$type] : 0;
        }

        if (!array_key_exists($type, static::$types)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'The value of type should be one of [%s], %s given',
                    implode(', ', array_keys(static::$types)),
                    $type
                )
            );
        }

        $this->type = (int) $type;
    }
}
