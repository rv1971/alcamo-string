<?php

namespace alcamo\string;

use alcamo\exception\InvalidEnumerator;

/**
 * @brief Object that represents a readonly string garanteed to be one of
 * @ref VALUES
 *
 * @attention Any derived classes must define a public constant
 * `VALUES` containing the valid values.
 *
 * @date Last reviewed 2025-10-08
 */
abstract class AbstractEnum extends ReadonlyStringObject
{
    public const VALUES = []; ///< Valid enumerators

    public function __construct(string $value)
    {
        if (!in_array($value, static::VALUES)) {
            /** @throw alcamo::exception::InvalidEnumerator if $value is not
             *  in @ref VALUES. */
            throw (new InvalidEnumerator())->setMessageContext(
                [
                    'value' => $value,
                    'expectedOneOf' => static::VALUES
                ]
            );
        }

        parent::__construct($value);
    }
}
