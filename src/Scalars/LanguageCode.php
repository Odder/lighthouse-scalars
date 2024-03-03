<?php

namespace Odder\LighthouseScalars\Scalars;

use GraphQL\Type\Definition\ScalarType;
use GraphQL\Error\Error;
use GraphQL\Language\AST\StringValueNode;
use Odder\LighthouseScalars\Concerns\ValidatesLanguageCode;

/**
 * The `LanguageCode` scalar type represents language codes as defined by ISO 639-1.
 * This scalar ensures that the input is a valid two-letter language code.
 */
class LanguageCode extends ScalarType
{
    use ValidatesLanguageCode;

    public $description = <<<TXT
        The `LanguageCode` scalar type represents language codes compliant with the ISO 639-1 standard. It validates that inputs are two-letter language codes within GraphQL queries and mutations.
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
        if (!$this->isValidLanguageCode($value)) {
            throw new Error("Cannot serialize value as ISO 639-1 language code: " . $value);
        }

        return strtolower($value);
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
        if (!$this->isValidLanguageCode($value)) {
            throw new Error("Not a valid ISO 639-1 language code: " . $value);
        }

        return strtolower($value);
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

        $value = $valueNode->value;

        if (!$this->isValidLanguageCode($valueNode->value)) {
            throw new Error("Not a valid ISO 639-1 language code: " . $value);
        }

        return strtolower($value);
    }
}
