<?php

namespace alcamo\string;

/**
 * @brief Expand placeholders in a text
 */
class Expander
{
    public const BASH_FORMAT = '${%s}';
    public const MAKE_FORMAT = '$(%s)';
    public const PSR3_FORMAT = '{%s}';

    private $replaceMap_ = []; ///< Map of strings to replacement strings

    /**
     * @param $data map of placeholder names to values.
     *
     * @param $format sprintf()-format containing one `%s` which will be
     * replaced by placeholder names.
     */
    public function __construct(
        iterable $data,
        string $format = self::PSR3_FORMAT
    ) {
        foreach ($data as $key => $value) {
            $this->replaceMap_[sprintf($format, $key)] = $value;
        }
    }

    /**
     * @brief Expand placeholders in $text
     *
     * Placeholders must occur in the text in the format given to
     * __construct(). Placeholders that do not occur in the $data given to
     * __construct() remain silently unchanged.
     */
    public function expand(string $text): string
    {
        return strtr($text, $this->replaceMap_);
    }
}
