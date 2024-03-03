<?php

namespace Odder\LighthouseScalars\Scalars;

use GraphQL\Type\Definition\ScalarType;
use GraphQL\Error\Error;
use GraphQL\Language\AST\StringValueNode;
use Odder\LighthouseScalars\Concerns\ValidatesCountryCode;
use Odder\LighthouseScalars\Concerns\ValidatesLanguageCode;

/**
 * The `Locale` scalar type represents locale identifiers, including language codes, optional script, and region codes.
 * This scalar ensures that the input matches the structure of locale identifiers like "en", "en-US".
 */
class Locale extends ScalarType
{
    use ValidatesCountryCode;
    use ValidatesLanguageCode;

    public ?string $description = <<<TXT
        The `Locale` scalar type represents locale identifiers compliant with IETF language tag format, which may include a language code, an optional script code, and an optional region code, such as "en", "en-US", or "zh-CN". Underscores in the input will be converted to hyphens to normalize the locale identifier.
        TXT;

    /**
     * Serializes an internal value to include in a response.
     *
     * @param mixed $value
     * @return string
     * @throws Error
     */
    public function serialize($value): string
    {
        $value = str_replace('_', '-', $value); // Convert underscores to hyphens
        if (!$this->isValidLocale($value)) {
            throw new Error("Cannot serialize value as locale: " . $value);
        }

        return $value;
    }

    /**
     * Parses an externally provided value (query variable) to use as an input.
     *
     * @param mixed $value
     * @return string
     * @throws Error
     */
    public function parseValue($value): string
    {
        $value = str_replace('_', '-', $value); // Convert underscores to hyphens
        if (!$this->isValidLocale($value)) {
            throw new Error("Not a valid locale: " . $value);
        }

        return $value;
    }

    /**
     * Parses an externally provided literal value (hardcoded in GraphQL query) to use as an input.
     *
     * @param \GraphQL\Language\AST\Node $valueNode
     * @param mixed[]|null $variables
     * @return string
     * @throws Error
     */
    public function parseLiteral($valueNode, ?array $variables = null): string
    {
        if (!$valueNode instanceof StringValueNode) {
            throw new Error("Can only parse strings, got: " . $valueNode->kind);
        }

        $value = str_replace('_', '-', $valueNode->value); // Convert underscores to hyphens
        if (!$this->isValidLocale($value)) {
            throw new Error("Not a valid locale: " . $value);
        }

        return $value;
    }

    /**
     * Validates if the provided string is a valid locale identifier.
     *
     * @param string $locale
     * @return bool
     */
    private function isValidLocale(string $locale): bool
    {
        $parts = explode('-', $locale);

        if (count($parts) > 2) {
            return false;
        }

        $language = $parts[0];
        $country = $parts[1] ?? '';
        return $this->isValidLanguageCode($language) && ($country === '' || $this->isValidCountryCode($country));
    }
}
