<?php

namespace Odder\LighthouseScalars\Scalars;

use GraphQL\Type\Definition\ScalarType;
use GraphQL\Error\Error;
use GraphQL\Language\AST\FloatValueNode;
use GraphQL\Language\AST\Node;

/**
 * The `PositiveFloat` scalar type represents floating point numbers that are greater than zero.
 * This scalar ensures that the input is a valid positive float.
 */
class NegativeFloat extends ScalarType
{
    public ?string $description = <<<TXT
        The `PositiveFloat` scalar type represents floating point numbers that are strictly greater than zero. It is designed to validate positive float values within GraphQL queries and mutations.
        TXT;

    /**
     * Serializes an internal value to include in a response.
     *
     * @param mixed $value
     * @return float
     * @throws Error
     */
    public function serialize($value): float
    {
        if (!is_numeric($value) || $value > 0) {
            throw new Error("Cannot serialize value as positive float: " . $value);
        }

        return (float)$value;
    }

    /**
     * Parses an externally provided value (query variable) to use as an input.
     *
     * @param mixed $value
     * @return float
     * @throws Error
     */
    public function parseValue($value): float
    {
        if (!is_numeric($value) || $value > 0) {
            throw new Error("Not a valid positive float: " . $value);
        }

        return (float)$value;
    }

    /**
     * Parses an externally provided literal value (hardcoded in GraphQL query) to use as an input.
     *
     * E.g.
     * {
     *   value: 10.5
     * }
     *
     * @param Node $valueNode
     * @param mixed[]|null $variables
     * @return float
     * @throws Error
     */
    public function parseLiteral($valueNode, ?array $variables = null): float
    {
        if (!$valueNode instanceof FloatValueNode) {
            throw new Error("Can only parse float values, got: " . $valueNode->kind);
        }

        $value = $valueNode->value;

        if (!is_numeric($value) || $value > 0) {
            throw new Error("Not a valid positive float: " . $value);
        }

        return (float)$value;
    }
}
