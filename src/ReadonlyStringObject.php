<?php

namespace alcamo\string;

use alcamo\exception\ReadonlyViolation;

/**
 * @brief Class that behaves much like a readonly string
 *
 * @date Last reviewed 2021-06-08
 */
class ReadonlyStringObject extends StringObject
{
    public function offsetSet($offset, $value)
    {
        /** @throw alcamo::exception::ReadonlyViolation in every
         *  invocation. */
        throw new ReadonlyViolation();
    }

    public function offsetUnset($offset)
    {
        /** @throw alcamo::exception::ReadonlyViolation in every
         *  invocation. */
        throw new ReadonlyViolation();
    }
}
