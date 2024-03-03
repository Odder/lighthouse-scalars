<?php

namespace Odder\LighthouseScalars\Scalars;

use GraphQL\Type\Definition\ScalarType;
use GraphQL\Error\Error;
use GraphQL\Language\AST\StringValueNode;

/**
 * Represents text formatted in Markdown.
 *
 * This scalar type is designed to handle Markdown text inputs,
 * ensuring they are properly represented as strings. It provides
 * a flexible approach to handling Markdown, potentially allowing
 * for sanitization or conversion processes to be implemented as needed.
 */
class Markdown extends ScalarType
{
    /**
     * @var string A description of the Markdown scalar type.
     */
    public ?string $description = "The `Markdown` scalar type represents text formatted in Markdown.";

    /**
     * Serializes a value to include in a response.
     *
     * @param mixed $value The value to be serialized.
     * @return string The serialized string.
     * @throws Error If the value cannot be serialized as a string.
     */
    public function serialize($value): string
    {
        if (!is_string($value)) {
            throw new Error("Cannot serialize value as Markdown: Value is not a string.");
        }

        return $value;
    }

    /**
     * Parses an externally provided value (query variable) to use as an input.
     *
     * @param mixed $value The value to be parsed.
     * @return string The parsed string.
     * @throws Error If the value cannot be represented as a string.
     */
    public function parseValue($value): string
    {
        if (!is_string($value)) {
            throw new Error("Cannot represent value as Markdown: Value is not a string.");
        }

        return $value;
    }

    /**
     * Parses an externally provided literal value (hardcoded in GraphQL query) to use as an input.
     *
     * @param \GraphQL\Language\AST\Node $valueNode The AST node containing the value.
     * @param array|null $variables Variables provided in the GraphQL query.
     * @return string The parsed string value.
     * @throws Error If the value node is not a StringValueNode or the value cannot be parsed.
     */
    public function parseLiteral($valueNode, ?array $variables = null): string
    {
        if (!$valueNode instanceof StringValueNode) {
            throw new Error('Query error: Can only parse strings got: ' . $valueNode->kind, [$valueNode]);
        }

        return $valueNode->value;
    }
}
