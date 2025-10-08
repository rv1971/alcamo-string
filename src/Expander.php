<?php

namespace alcamo\string;

/**
 * @brief Expand placeholders in a text
 *
 * @date Last reviewed 2025-10-08
 */
class Expander
{
    public const BASH_FORMAT = '${%s}';
    public const MAKE_FORMAT = '$(%s)';
    public const PSR3_FORMAT = '{%s}';

    public const DEFAULT_FORMAT = self::PSR3_FORMAT;

    private $replaceMap_ = []; ///< Map of strings to replacement strings

    /// Convenience function
    public static function simpleExpand(
        string $text,
        iterable $data,
        ?string $format = null
    ): string {
        return (new static($data, $format ?? self::DEFAULT_FORMAT))
            ->expand($text);
    }

    /**
     * @param $data map of placeholder names to values.
     *
     * @param $format sprintf()-format containing one `%s` which will be
     * replaced by placeholder names.
     */
    public function __construct(
        iterable $data,
        ?string $format = null
    ) {
        if (!isset($format)) {
            $format = self::DEFAULT_FORMAT;
        }

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
