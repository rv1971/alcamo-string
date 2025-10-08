<?php

namespace alcamo\string;

use alcamo\exception\{OutOfRange, Unsupported};

/**
 * @namespace alcamo::string
 *
 * @brief Objects behaving as strings
 */

/**
 * @brief Class that behaves much like a string
 *
 * All positions are counted in bytes, not in characters. This makes a
 * difference for UTF-8 strings.
 *
 * @date Last reviewed 2025-10-08
 */
class StringObject implements \ArrayAccess, \Countable
{
    protected $text_; ///< The actual string

    public function __construct(string $text)
    {
        $this->text_ = $text;
    }

    public function __toString(): string
    {
        return $this->text_;
    }

    /* == Countable interface == */

    public function count()
    {
        return strlen($this->text_);
    }

    /* == ArrayAccess interface as for strings == */

    public function offsetExists($offset)
    {
        return isset($this->text_[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->text_[$offset];
    }

    public function offsetSet($offset, $value)
    {
        if (!isset($this->text_[$offset])) {
            /** @throw alcamo::exception::OutOfRange when attempting to modify
             *  a position outside of the existing string. */
            throw (new OutOfRange())->setMessageContext(
                [
                    'value' => $offset,
                    'lowerBound' => 0,
                    'upperBound' => strlen($this->text_) - 1
                ]
            );
        }

        $this->text_[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        /** @throw alcamo::exception::Unsupported in every invocation
         *  since unsetting single positions is not supported. */
        throw (new Unsupported())->setMessageContext(
            [
                'feature' => 'Unsetting bytes in a string',
                'inData' => $this->text_,
                'atOffset' => $offset
            ]
        );
    }
}
