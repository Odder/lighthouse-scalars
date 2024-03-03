<?php

namespace Odder\LighthouseScalars\Scalars;

use GraphQL\Type\Definition\ScalarType;
use GraphQL\Error\Error;
use GraphQL\Language\AST\StringValueNode;

/**
 * The `Email` scalar type represents email addresses compliant to the RFC 5321 specification.
 * This scalar ensures that the input is a valid email address format.
 */
class Email extends ScalarType
{
    public ?string $description = <<<TXT
        The `Email` scalar type represents email addresses, ensuring inputs are compliant with the RFC 5321 specification. It is designed to validate email address formats within GraphQL queries and mutations.
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
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new Error("Cannot serialize value as email: " . $value);
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
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new Error("Not a valid email: " . $value);
        }

        return $value;
    }

    /**
     * Parses an externally provided literal value (hardcoded in GraphQL query) to use as an input.
     *
     * E.g.
     * {
     *   user(email: "user@example.com")
     * }
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

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new Error("Not a valid email: " . $value);
        }

        return $value;
    }
}