<?php

namespace Webtown\UtilityBundle\Enum;

/**
 * Class AbstractStatus
 *
 * Ha státuszt vagy állapotot szeretnénk tárolni, akkor ebből származtassuk az objektumot.
 *
 * @package Webtown\UtilityBundle\Enum
 */
abstract class AbstractStatus
{
    public static $states;

    protected $status;

    public function __construct($status)
    {
        $this->setStatus($status);
    }

    public function __toString()
    {
        return static::$states[$this->status];
    }

    public function getStatus()
    {
        return $this->status;
    }

    protected function setStatus($status)
    {
        // checks if the status is string, but skips it if it can be converted to int "1" -> 1
        if (is_string($status) && (int) $status === 0) {
            $states = array_flip(static::$states);
            $status = isset($states[$status]) ? $states[$status] : 0;
        }

        if (!array_key_exists($status, static::$states)) {
            throw new \InvalidArgumentException(
                sprintf(
                    'The value of status should be one of [%s], %s given',
                    implode(', ', array_keys(static::$states)),
                    $status
                )
            );
        }

        $this->status = (int) $status;
    }
}
